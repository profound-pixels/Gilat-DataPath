<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package PPx_Starter_Theme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-57486231-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-57486231-1');
</script>

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php 
//PPX-HEAD 1.0 HEADER
?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ppx-starter' ); ?></a>

	<header id="masthead" class="site-header uk-navbar-container uk-margin-medium-bottom uk-box-shadow-medium" uk-sticky>
        
        <?php //PPX-HEAD 2.0 NAVIGATION ?>
		<nav id="site-navigation" class="uk-container" uk-navbar>
<!--			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ppx-starter' ); ?></button>-->
               
                <div class="uk-navbar-left">
                <?php echo get_custom_logo() ?>
                </div>
                <div class="uk-navbar-right uk-flex-stretch">
                    <div class="uk-visible@l uk-flex">
                        <ul id="primary-menu" class="uk-navbar-nav">
                            <li>
                                 <a href="#" class="uk-padding-small div-left uk-display-block header-bar header-bar-hover header-bar-short">
                                     <div class="uk-width-small">
                                         SATCOM
                                         <div class="uk-navbar-subtitle uk-text-muted uk-text-uppercase">Portables and Transportables</div>
                                     </div>
                                 </a>
                                 <div class="primary-menu-drop div-top menu-column-div-right uk-width-3-5 div-horizontal div-bottom" uk-dropdown="animation: uk-animation-slide-top-small; duration: 150">
    <!--                                 SATCOM Menu here!-->
                                        <?php 
                                        wp_nav_menu( array(
                                            'theme_location'    => 'menu-primary-satcom-desktop',
                                            'menu_id'           => 'menu-satcom-sub',
                                            'menu_class'        => 'uk-nav uk-nav-default',
                                            'container'         => 'div',
                                            'container_class'   => '',
                                        ) );
                                        ?>
                                 </div>
                            </li> 
                            <li>
                                 <a href="#" class="uk-padding-small div-left uk-display-block header-bar header-bar-hover header-bar-short">
                                     <div class="uk-width-small">
                                         SOFTWARE
                                         <div class="uk-navbar-subtitle uk-text-muted uk-text-uppercase">Network Monitoring<br> and Control</div>
                                     </div>
                                 </a>
                                 <div class="primary-menu-drop div-top div-bottom uk-width-medium div-horizontal" uk-dropdown>
    <!--                                 CYBER &amp; Apps Menu here!-->
                                        <?php 
                                        wp_nav_menu( array(
                                            'theme_location'    => 'menu-primary-apps-desktop',
                                            'menu_id'           => 'menu-apps-sub',
                                            'menu_class'        => 'uk-nav uk-nav-default',
                                            'container'         => 'div',
                                            'container_class'   => '',
                                        ) );
                                        ?>
                                 </div>
                             </li>
                            <li>
                                 <a href="#" class="uk-padding-small div-left uk-display-block header-bar header-bar-hover header-bar-short">
                                     <div class="uk-width-small">
                                         TECH SERVICES
                                         <div class="uk-navbar-subtitle uk-text-muted uk-text-uppercase">Field Services, Customer Support, ILS</div>
                                     </div>
                                 </a>
                                 <div class="primary-menu-drop div-top div-horizontal div-bottom" uk-dropdown>
    <!--                             Tech Services Menu-->
                                 <?php 
                                  wp_nav_menu( array(
                                      'theme_location'    => 'menu-primary-services-desktop',
                                      'menu_id'           => 'menu-services-sub',
                                      'menu_class'        => 'uk-nav uk-nav-default',
                                      'container'         => 'div',
                                      'container_class'   => '',
                                  ) );
                                  ?>
                                 </div>
                             </li>
                            <li>
                                 <a href="#" class="uk-padding-small div-left uk-display-block header-bar header-bar-hover header-bar-short">
                                     <div class="uk-width-small">
                                         COMPANY
                                         <div class="uk-navbar-subtitle uk-text-muted uk-text-uppercase">About, News, Events,<br>Careers, Suppliers</div>
                                     </div>
                                 </a>
                                 <div class="primary-menu-drop menu-column-div-right div-top uk-width-large div-horizontal div-bottom" uk-dropdown="pos: bottom-right">
    <!--                             Company Menu-->
                                 <?php 
                                  wp_nav_menu( array(
                                      'theme_location'    => 'menu-primary-company-desktop',
                                      'menu_id'           => 'menu-company-sub',
                                      'menu_class'        => 'uk-nav uk-nav-default',
                                      'container'         => 'div',
                                      'container_class'   => '',
                                  ) );
                                  ?>
                                 </div>
                             </li>
                         </ul>
                     </div>
                
               </div> <!--End Navbar Right -->
               
               <div id="primary-contact" class="uk-navbar-right uk-margin-remove-left div-left">
                   <ul class="uk-navbar-nav">
                       <li><a uk-tooltip="title: Contact Us; pos: bottom" arial-label="Open Contact Us Panel" href="#" class="uk-padding" uk-icon="icon: comment; ratio: 2"  uk-toggle="target: #contact-panel"></a></li>
                   </ul>
               </div> <!-- #primary-contact -->
               
               <?php //PPX-HEAD 2.2 SET DROPDOWN STYLE ?>
                
                <div class="uk-navbar-right uk-margin-remove-left uk-hidden@l div-left">
                    <button class="uk-padding uk-navbar-toggle" uk-icon >
                        <svg width="36" height="20" viewBox="0 0 36 20" xmlns="http://www.w3.org/2000/svg" data-svg="navbar-toggle-icon">
                            <rect y="9" width="36" height="3"></rect>
                            <rect y="3" width="36" height="3"></rect>
                            <rect y="15" width="36" height="3"></rect>
                        </svg>
                    </button>
                </div>
                
                <?php //PPX-HEAD 2.3 DROPDOWN NAV ?>
                
                <div class="uk-margin uk-margin-remove-top div-top" uk-dropdown="mode: click; pos: bottom-justify; boundary: #site-navigation; boundary-align: true">
                    <?php
                        wp_nav_menu( array(
                            'theme_location'    => 'menu-primary-mobile',
                            'menu_id'           => 'mobile-menu',
                            'menu_class'        => 'uk-nav-default uk-dropdown-nav uk-nav-parent-icon',
                        ) );
                        ?>
                </div>
                
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->
   
    <?php //PPX-HEAD 2.4 OFFSET NAV ?>
    
    <div id="contact-panel" uk-offcanvas="overlay: true; flip: true" class="">
        
        <div class="uk-offcanvas-bar uk-padding-remove uk-background-default uk-box-shadow-medium">
            <div class="uk-background-default div-bottom">
                <div class="uk-padding">
                    <h2 class="header-bar">Contact</h2>
                    <p>Send an email for product, system, or service pricing.</p>
                    <ul class="uk-nav uk-list">

                        <li><span class="uk-margin-small-right uk-text-warning" uk-icon="icon: mail"></span><a class="uk-display-inline" href="mailto:sales@datapath.com">sales@datapath.com</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="uk-padding uk-background-default div-bottom">
                <h3 class="header-bar header-bar muted uk-h4">Network Operations Center</h3>
                <div class="uk-grid" uk-grid>
                    <span class="uk-margin-small-right uk-text-warning uk-flex" uk-icon="icon: receiver"></span>
                    <span class="uk-padding-remove-left uk-margin-remove-top uk-width-expand uk-text-top">+1 (866) 491-0842</span>
                </div>
            </div>
            <div class="uk-padding uk-background-default div-bottom">
                <h3 class="header-bar header-bar muted uk-h4">Parts Quotes</h3>
                <p class="uk-margin-remove-bottom">Please click <strong><a href="/request-a-spare-parts-quote/">here</a></strong> to request a parts quote.</p>
            </div>
            
            
        </div>
        <div id="contact-panel-close-wrapper" class="uk-offcanvas-bar uk-padding-remove uk-background-default uk-offcanvas-bar-animation uk-offcanvas-slide">
            <a id="contact-panel-close" class="uk-close-large uk-align-left uk-padding-small uk-position-absolute uk-background-default" uk-toggle="target: #contact-panel" uk-close></a>
        </div>
    </div>

	<div id="content" class="site-content">
