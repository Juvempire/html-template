<article <?php post_class( 'content-card service-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?><a class="card-media" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a><?php endif; ?>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
    <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn more', 'agenio-personal' ); ?></a>
</article>
