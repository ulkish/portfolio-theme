<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
        <nav class="nav justify-content-center p-2 bg-light">
            <a class="nav-link lead" href="/newwp/"><?php _e('Home', 'customtheme'); ?></a>
            <a class="nav-link lead" href="/newwp/projects/"><?php _e('Projects', 'customtheme'); ?></a>
            <a class="nav-link lead" href="/newwp/blog/">Blog</a>
        </nav>
        <?php wp_head(); ?>
    </head>

    <?php
        if( is_front_page() ):
            $customt_classes = array( 'customt_class', 'my_class');
        else:
            $customt_classes = array('no_customt_class') ;
        endif;
    ?>

<body <?php body_class( $customt_classes ); ?>>
