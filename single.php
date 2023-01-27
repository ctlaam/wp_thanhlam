<?php  get_header(); ?>
<div class="content">
    <div class="main-content">

        <?php if(have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('content',get_post_format(  )); ?>
            <?php endwhile; ?>
            <?php thanhlam_pagination(); ?>
            <?php else: ?>
                <?php get_template_part('content','none')?>
        <?php endif; ?>
        
    </div>
    <div class="sidebar">
        <?php get_sidebar(); ?>
    </div>
</div>
<!-- <h1><?php the_title(); ?></h1> --> 
<?php  get_footer(); ?>