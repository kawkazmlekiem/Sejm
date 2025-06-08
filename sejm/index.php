<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 
get_header(); ?>

<main>
    <h2>Lista posłów obecnej kadencji<h2>
        <section class='mpTiles'>
            <?php
            $args = ['post_type' => 'mp', 'posts_per_page' => -1];
            $query = new WP_Query($args);
            while ($query->have_posts()) : $query->the_post(); ?>
            <div class='mpTile'>
                 <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p><?php echo get_field('club'); ?></p>   
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
        </section>
</main> 

<?php get_footer(); ?>