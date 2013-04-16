<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 */
?>

        </div> <!-- #main-container -->

        <div class="footer-container">
            <footer>
					<div id="footerLeft">
						<?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'container_class' => 'footerMenu', 'menu' => 'footer' ) ); ?> 
					</div>
					<div id="footerRight">
						<div class="social"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/tweet_button.1355514129.html#_=1357201112757&amp;count=horizontal&amp;hashtags=hifi&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fmoosaudio.com%2Fpages%2Fpress&amp;size=l&amp;text=Moos%20%E2%80%93%20Turn%20It%20Up&amp;url=http%3A%2F%2Fmoosaudio.com&amp;via=moosaudio" class="twitter-share-button twitter-count-horizontal" style="width: 138px; height: 28px;" title="Twitter Tweet Button" data-twttr-rendered="true"></iframe>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
						
						<div class="social"><iframe allowtransparency="true" frameborder="0" scrolling="no" src="https://platform.twitter.com/widgets/follow_button.1355514129.html#_=1357201112768&amp;id=twitter-widget-1&amp;lang=en&amp;screen_name=moosaudio&amp;show_count=false&amp;show_screen_name=true&amp;size=l" class="twitter-follow-button" style="width: 162px; height: 28px;" title="Twitter Follow Button" data-twttr-rendered="true"></iframe>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
						<div class="fb-like social fb_edge_widget_with_comment fb_iframe_widget" data-href="http://moosaudio.com" data-send="true" data-width="450" data-show-faces="false" data-font="lucida grande"></div>
					</div>
            </footer>
        </div>
        <script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>

	</div><!-- #main .wrapper -->
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>