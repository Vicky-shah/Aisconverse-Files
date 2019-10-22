
<footer>
    <div class="container">
        <div class="ft-logo">
            <?php $footerLogo =  get_theme_mod( "test_theme_footer_img_settings" );
            if(!empty($footerLogo)){?>
            <img src="<?php echo $footerLogo; ?>" alt="">
            <?php }?>
        </div><!--ft-logo end-->
        <div class="clearfix"></div>
    </div>
</footer><!--footer end-->


</div><!--theme-layout end-->


<?php wp_footer();?>
</body>
</html>