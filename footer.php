<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PPx_Starter_Theme
 */

?>

	</div><!-- #content -->
<?php //PPX-FOOT 1.0 FOOTER ?>

<div id="page-bottom" class="uk-margin-xlarge-top">
    <?php //PPX-FOOT 1.0 FOOTER ?>
	<?php if (is_page() && is_active_sidebar( 'page-bottom-1' ) ) : ?>
        <aside id="sidebar-output" class="uk-background-muted uk-padding uk-padding-remove-horizontal">
         <div class="uk-container">
             <?php dynamic_sidebar( 'page-bottom-1' ); ?>
         </div>
        </aside>
    <?php endif; ?> <!-- #page-bottom-1 output -->
</div>

	<footer id="colophon" class="site-footer uk-background-secondary uk-padding-large uk-padding-remove-horizontal">
	
		<div class="site-info uk-container">
		<hr class="uk-margin-medium">
			<div class="uk-grid uk-text-small" uk-grid>
			    <div class="uk-width-1-2@s uk-width-2-3@m">
			        <?php 
                    wp_nav_menu( array(
                        'theme_location'    => 'menu-footer-desktop',
                        'menu_id'           => 'menu-footer-desktop',
                        'menu_class'        => 'uk-nav uk-nav-default',
                        'container'         => 'div',
                        'container_class'   => '',
                    ) );
//                    wp_nav_menu( array(
//                        'theme_location'    => 'menu-footer-mobile',
//                        'menu_id'           => 'menu-footer-mobile',
//                        'menu_class'        => 'uk-nav uk-nav-default',
//                        'container'         => 'div',
//                        'container_class'   => '',
//                    ) );
                    ?>
                    
			    </div>
			    <div class="uk-width-1-2@s uk-width-1-3@m">
			        <ul id="dp_addresses" class="uk-list uk-light">
			            <li class="uk-margin-bottom">
			                <h6 class="header-bar header-bar-muted">Headquarters</h6>
			                <p>
			                    2205 Northmont Parkway, Suite 100<br>
                                Duluth, GA 30096<br>
                                +1 678 597 0300<br>
			                </p>
			            </li>
                        <li class="uk-margin-bottom">
			                <h6 class="header-bar header-bar-muted">International AB</h6>
			                <p>
			                    Vågögatan 6, P.O. Box 1261<br>
                                SE-164 29 Kista, Sweden<br>
                                +46 8 728 50 00
			                </p>
			            </li>
                        <li class="uk-margin-bottom">
			                <h6 class="header-bar header-bar-muted">Global Services</h6>
			                <p>
			                    6170 Guardian Gateway, Suite 112<br>
                                Aberdeen Proving Ground, MD 21005<br>
			                </p>
			            </li>
			        </ul>
			    </div>
			</div>
			
			
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
