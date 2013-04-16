//create a dummy console if firebug not installed
if (window.console === undefined) {
   var ConsoleObject = function(){
      this.time = function(){
      };
      this.timeEnd = function(){
      };
      this.group = function(){
      };
      this.groupEnd = function(){
      };
      this.dir = function(){
      };
      this.log = function(){
      };
   };
   window.console = new ConsoleObject();
}

function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function isValidEmailAddress(emailAddress) {
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	return pattern.test(emailAddress);
}
