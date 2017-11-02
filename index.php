<?php get_header(); ?>
<main id="main" class="container site-main" role="main">
        
    <?php
    if( have_posts() ) {

        /* Start the loop */
        while( have_posts() ) {
            
            the_post();

            /**
             * Use the Post-Formats support module to 
             *  allow custom formatting on posts.
             * Example: using the aside format on a post will load
             *  template-parts/post/content-aside.php (note the added text to slug)
             */
            get_template_part( 'template-parts/post/content', get_post_format() );                
        
        }
    
    }
    else {

        /**
         * When there is no posts available
         *  load no content post format
         */
        get_template_part( 'template-parts/post/content', 'none' ); 
    
    }
    ?>

</main><!-- #main -->

<?php get_footer() ?>