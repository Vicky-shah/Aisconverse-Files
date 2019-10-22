<!DOCTYPE html>
<html>
<head>
    <?php wp_head();?>
</head>
<body>

<div class="theme-layout">
    <header>
        <div class="container">
            <?php $custom_logo_id = get_theme_mod( 'custom_logo' );
                  $logo = wp_get_attachment_image_src( $custom_logo_id , 'full' );
                    if ( has_custom_logo() ) {
                        $logoImage = '<a href="'.get_home_url().'" title=""><img src="' . esc_url( $logo[0] ) . '" alt="' . get_bloginfo( 'name' ) . '"></a>';
                        } else {
                        $logoImage = '<h1>'. get_bloginfo( 'name' ) .'</h1>';
                    }?>
            <div class="logo">
                <a href="#" title="">
                    <?php echo $logoImage; ?>
                </a>
            </div><!--logo end-->
            <?php $phoneNumber =  get_theme_mod( "test_theme_phone_number" );
            if(!empty($phoneNumber)){?>
            <div class="contact-info">
                <h3><?php echo $phoneNumber;?></h3>
            </div><!--contact-info end-->
            <?php }?>
            <div class="menu-btn">
                <a href="#" title="">
                    <span class="bar1"></span>
                    <span class="bar2"></span>
                    <span class="bar3"></span>
                </a>
            </div><!--menu-btn end-->
            <div class="clearfix"></div>
        </div>
    </header><!--header end-->


    <section class="navi-sec">
        <div class="container">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Header Search Area") ) : ?>
            <?php endif;?>
            <nav>
                <ul>
                    <?php wp_nav_menu( array( 'items_wrap' => '%3$s', 'menu_id' => 'main-menu' ) );?>
                </ul>
            </nav><!--navigation end-->
            <div class="clearfix"></div>
        </div>
    </section><!--navi-sec end-->