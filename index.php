<?php
/*
    Template Name: Curriculum Template
*/
get_header();
get_template_part('index-header');
?>




<?php
query_posts(array(
   'post_type' => 'curriculum'
));
?>
    <?php

    if( have_posts() ):

        while( have_posts() ): the_post(); ?>

        <?php $current_position = get_field('current_position'); ?>
        <?php  $portrait = get_field('portrait');?>
        <?php  $degrees_and_certificates = get_field('degrees_and_certificates');?>


            <section id="my_perfil">
                <div class="row vertical py-4">
                    <div class="col-sm-12 col-md-7">
                        <h1 class="text-center my_title mb-5 mx-4 p-2 rounded"><?php echo $current_position; ?></h1>
                        <div class="text-center h4 mb-3">
                            <?php the_content() ?>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-5">
                        <img class="img-fluid rounded-circle my_pic" src="<?php echo $portrait['url']; ?>" alt="<?php echo $portrait['alt']; ?>" />
                    </div>
                </div>
            </section>

            <div class="container bg-light rounded">


                <span class="mx-auto text-center d-block my_title rounded p-2 mb-5 bg-white" style="width: 370px;"><?php _e('Certifications', 'customtheme'); ?></span>
                <?php
                while ( have_rows('degrees_and_certificates') ) : the_row(); // Loop through degrees and certificates
                    while ( have_rows('degrees') ) : the_row(); // Loop through degrees?>
                        <div class="col-md-12 text-center mb-4">
                            <span class="lead bg-white text-dark rounded p-2 inline text-center"><?php echo the_sub_field('degree'); ?></span>
                        </div>
             <?php  endwhile; ?>



                <div class="row px-2 ">
                    <?php  while ( have_rows('institution') ) : the_row(); //Loop through certificates?>
                     <div class="col-md-12 mb-3">
                          <ul class="list-group">
                              <li class="list-group-item bg-dark text-white text-center lead" id="list_title"><?php echo the_sub_field('name'); ?></li>
                              <div class="row">
                                      <?php
                                      $total = count(get_sub_field('certificates'));
                                      $i=0;
                                      while ( have_rows('certificates') ) : the_row();
                                          $i++;
                                          if (fmod ( $total , 2 )!=0 && $total == $i){
                                              $is_last = "fullwidth text-center";
                                          } else {
                                              $is_last = "";
                                          }
                                        ?>
                                            <li class="list-group-item col-md-12 col-lg-6 <?php echo $is_last; ?>"><i class="fa fa-check-square"></i> <?php echo the_sub_field('certificate_name'); ?></li>
                                      <?php   endwhile; ?>
                             </div>
                          </ul>
                      </div>
                    <?php  endwhile; //End certificates loop?>
                </div>



            <?php    endwhile; // End degrees and certificates loop?>
            </div>

             <div class="container my-4">
                <span class="mx-auto text-center d-block my_title rounded p-2 mb-5" style="width: 300px;"><?php _e('Technologies', 'customtheme'); ?></span>
                <?php while ( have_rows('technologies') ) : the_row(); //Loop through technologies?>
                    <h4><?php echo the_sub_field('name'); ?></h4>
                    <div class="progress mb-3">
                        <div class="progress-bar bg-dark" style="width:<?php echo the_sub_field('mastery_percentage'); ?>%"></div>
                    </div>
                <?php endwhile; //End of technologies loop?>
            </div>

            <div class="container">
                <div class="row px-2 py-4">
                    <div class="col-md-12 col-lg-6">
                        <ul class="list-group">
                            <?php while ( have_rows('books') ) : the_row(); //Loop through books group?>
                                <li class="list-group-item bg-dark text-white lead" id="list_title"><?php _e('Programming books I have read', 'customtheme'); ?>:</li>
                                <?php while ( have_rows('books_read') ) : the_row(); ?>
                                    <li class="list-group-item"><i class="fa fa-check-square"></i> <?php echo the_sub_field('book'); ?></li>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                    <div class="col-md-12 col-lg-6">
                        <ul class="list-group">
                            <?php while ( have_rows('books') ) : the_row(); //Loop through books group?>
                                <li class="list-group-item bg-dark text-white lead" id="list_title"><?php _e('Books I am currently reading', 'customtheme'); ?>:</li>
                                <?php while ( have_rows('books_being_read') ) : the_row(); ?>
                                    <li class="list-group-item"><i class="fa fa-cog fa-spin"></i> <?php echo the_sub_field('book'); ?></li>
                                <?php endwhile; ?>
                            <?php endwhile; ?>
                        </ul>
                    </div>

                </div>
            </div>



        <?php endwhile;
    endif;
    ?>
<?php get_footer(); ?>
