<?php get_header();?>
    <section class="banner-sec">
        <div class="container">
            <div class="banner-slider">
                <?php echo test_theme_banner_slider();?>
            </div><!--banner-slider end-->
        </div>
    </section><!--banner-sec end-->

    <section class="main-content">
        <div class="container">
            <div class="about-us">

                <h3><?php the_field('about_heading', get_the_ID());?></h3>
                <p><?php the_field('about_description', get_the_ID());?></p>
            </div><!--about-us end-->
            <div class="blog-section">
                <h3>Our News</h3>
                <div class="blog-posts">
                    <?php echo test_theme_news_function();?>
                </div><!--blog-posts end-->
            </div><!--blog-section end-->
            <div class="clearfix"></div>
        </div>
    </section><!--main-content end-->
<?php get_footer();?>