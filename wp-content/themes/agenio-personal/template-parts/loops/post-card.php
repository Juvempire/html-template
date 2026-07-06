<article <?php post_class( 'content-card post-card' ); ?>>
    <?php if ( has_post_thumbnail() ) : ?><a class="card-media" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a><?php endif; ?>
    <p class="eyebrow"><?php agenio_posted_on(); ?></p>
    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <p><?php echo esc_html( get_the_excerpt() ); ?></p>
    <a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read article', 'agenio-personal' ); ?></a>
</article>
