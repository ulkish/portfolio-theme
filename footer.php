    <footer class="footer">
        <div class="text-center bg-secondary">
            <span class="my_title p-2 my_footer_title rounded mt-2"><?php _e('Contact', 'customtheme'); ?></span>
            <div class="container">

                <div class="row py-4">
                    <div class="col-lg-3 mb-3">
                        <a href="<?php echo get_option('cv_url'); ?>" class="btn btn-block btn-lg btn-light" download="CurriculumVitae.pdf"><i class="fas fa-file-download"></i> <?php _e('Download CV', 'customtheme'); ?></a>
                    </div>
                    <div class="col-md-4">
                        <p class="text-white p-2 h3 text-center border-bottom"><i class="fa fa-phone-square"></i> <?php _e('Phone', 'customtheme'); ?>: <?php echo get_option('phone_number'); ?></p>
                    </div>
                    <div class="col-md-5">
                        <p class="text-white p-2 h3 text-center border-bottom"><i class="fa fa-envelope"></i> Email: <?php echo get_option('email_text'); ?></p>
                    </div>
                </div>
                <?php echo do_shortcode("[wpforms id='196']	"); ?>
            </div>
            <div class="text-white text-center bg-dark py-2">Coded by Hugo Moran.</div>
        </div>



    </footer>
    <?php wp_footer(); ?>
    </body>
</html>
