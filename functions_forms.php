<?php
/**
* Better Inventory with Gravity Forms / Limit by Sum of Field Values
* http://gravitywiz.com/2012/05/19/simple-ticket-inventory-with-gravity-forms/
*/

define("TOTAL_SPEAKERS", 5000);
define("SPEAKER_PRICE_CENTS", 8000);

/*
class GWLimitBySum {

    private $_args;
    
    function __construct($args) {
        
        $this->_args = wp_parse_args($args, array(
            'form_id' => false,
            'field_id' => false,
            'limit' => 20,
            'limit_message' => __('Sorry, this item is sold out.'),
            'validation_message' => __('You ordered %1$s of this item. There are only %2$s of this item left.'),
            'approved_payments_only' => false,
            'hide_form' => false
            ));
        
        $this->_args['input_id'] = $this->_args['field_id'];
        extract($this->_args);
        
        add_filter("gform_pre_render_$form_id", array(&$this, 'limit_by_field_values'));
        add_filter("gform_validation_$form_id", array(&$this, 'limit_by_field_values_validation'));
        
        if($approved_payments_only)
            add_filter('gwlimitbysum_query', array(&$this, 'limit_by_approved_only'));
        
    }
    
    public function limit_by_field_values($form) {
        
        $sum = self::get_field_values_sum($form['id'], $this->_args['input_id']);
        if($sum < $this->_args['limit'])
            return $form;
        
        if($this->_args['hide_form']) { 
            add_filter('gform_get_form_filter', create_function('', 'return "' . $this->_args['limit_message'] . '";'));
        } else {
            add_filter('gform_field_input', array(&$this, 'hide_field'), 10, 2);
        }
          
        return $form;
    }

    public function limit_by_field_values_validation($validation_result) {
        
        extract($this->_args);
        
        $form = $validation_result['form'];
        $exceeded_limit = false;
        
        foreach($form['fields'] as &$field) {
            
            if($field['id'] != intval($input_id))
                continue;
            
            $requested_value = rgpost("input_" . str_replace('.', '_', $input_id));
            $field_sum = self::get_field_values_sum($form['id'], $input_id);
            
            if($field_sum + $requested_value <= $limit)
                continue;
                
            $exceeded_limit = true;
            $number_left = $limit - $field_sum >= 0 ? $limit - $field_sum : 0;
            
            $field['failed_validation'] = true;
            $field['validation_message'] = sprintf($validation_message, $requested_value, $number_left);
            
        }
        
        $validation_result['form'] = $form;
        $validation_result['is_valid'] = !$validation_result['is_valid'] ? false : !$exceeded_limit;
        
        return $validation_result;
    }

    public function hide_field($field_content, $field) {
        
        if($field['id'] == intval($this->_args['input_id']))
            return "<div class=\"ginput_container\">{$this->_args['limit_message']}</div>";
        
        return $field_content;
    }
    
    public static function get_field_values_sum($form_id, $input_id) {
        global $wpdb;
        
        $query = apply_filters('gwlimitbysum_query', array(
            'select' => 'SELECT sum(value)',
            'from' => "FROM {$wpdb->prefix}rg_lead_detail ld", 
            'where' => $wpdb->prepare("WHERE ld.form_id = %d AND CAST(ld.field_number as unsigned) = %d", $form_id, $input_id)
            ));
        
        $sql = implode(' ', $query);
        return $wpdb->get_var($sql);
    }
    
    public static function limit_by_approved_only($query) {
        $query['from'] .= ' INNER JOIN wp_rg_lead l ON l.id = ld.lead_id';
        $query['where'] .= ' AND l.payment_status = \'Approved\'';
        return $query;
    }
    
}

*/

/*
new GWLimitBySum(array(
	'form_id' => 1,
	'field_id' => 5,
	'limit' => TOTAL_SPEAKERS,
	'limit_message' => 'Sorry, there are no more preorders available.',
	'validation_message' => 'You ordered %1$s speakers, but there are only %2$s speakers left.',
	'approved_payments_only' => false,
	'hide_form' => false
));
*/

add_action("gform_after_submission_1", "reservePostSubmit", 10, 2);


function reservePostSubmit($entry, $form){
	//$stuff = json_encode($entry);
	
	//mail("rileypmills@gmail.com", "Form Data", $stuff);
	
	//return;

	$token = $entry['8'];
	$email = $entry['4'];
	$name = $entry['9'];
   $color = trim(strip_tags($entry['11']));
	
	$customer = Stripe_Customer::create(array(
		"card" => $token,
		"email" => $email,
		"description" => $name . ", Color: " . $color)
	);
}

add_filter("gform_validation_message", "change_message", 10, 2);
function change_message($message, $form){
  return "There was a problem with your submission. Please check highlighted items.";
}


?>