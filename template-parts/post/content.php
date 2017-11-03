<?php
/**
 * Template part used to display post content
 * This is the default content file
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="post-container">
        <header class="entry-header">
            
            <?php
            if ( is_single() ) {
                the_title( '<h1 class="entry-title">', '</h1>' );
            } elseif ( is_front_page() && is_home() ) {
                the_title( '<h2 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
            } else {
                the_title( '<h3 class="entry-title"><a class="entry-title-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
            }
            ?>
    
        </header>
        <div class="entry-content">
    
            <?php
            if ( is_singular() ) {
                the_content();
            }
            else {
                the_excerpt();
            }
            ?>
    
        </div>
    </div>
</article><!-- #post-## -->