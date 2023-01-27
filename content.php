<article id="post <?php the_ID() ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php thanhlam_thumbnail('thumbnail') ?>
    </div>
    <div class="entry-header">
        <?php thanhlam_entry_header(); ?>
        <?php thanhlam_entry_meta(); ?>
    </div>
    <div class="entry-content"></div>

</article>