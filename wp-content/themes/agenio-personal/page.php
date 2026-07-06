<?php
get_header();
while ( have_posts() ) : the_post();
?>
<section class="page-hero compact">
    <div class="agenio-container">
        <h1><?php the_title(); ?></h1>
    </div>
</section>
<section class="content-section">
    <div class="agenio-container narrow entry-content">
        <?php the_content(); ?>
    </div>
</section>
<?php endwhile; get_footer(); ?>
