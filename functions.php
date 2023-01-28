<?php

/**
 * @THEME_URI = Lay duong dan thu muc theme
 * CORE = Lay duong dan thu muc core
 */

define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . "/core");

/**
 * nhung file core/init.php
 */
require_once(CORE . "/init.php");
if( !isset($content_width)){
    $content_width = 620;
}

if(!function_exists('thanhlam_theme_setup')){
    function thanhlam_theme_setup(){
        // thiet lap text domain
        $language_folder = THEME_URL . '/languages';
        load_theme_textdomain('thanhlam',$language_folder);

        // tu dong them link rss len <head></head>
        add_theme_support( 'automatic-feed-links' );

        // them post thumbnail
        add_theme_support( 'post-thumbnails' );

        // post format
        add_theme_support( 'post-formats', array(
            'image','video','gallery','quote','link'
        ) );
        
        // them title-tag
        add_theme_support( 'title-tag' );

        // them custom background
        $default_background = array(
            'default-color'=> '#e8e8e8'
        );
        add_theme_support( 'custom-background',$default_background );

        // Them menu
        register_nav_menu('primary-menu', __('Primary Menu', 'thanhlam'));

        // them siddbar
        $sidebar = array(
            'name' => __('Main Sidebar', 'thanhlam'),
            'id' => 'main_sidebar',
            'description' => __('Default Sidebar'),
            'class' => 'main_sidebar',
            'before_title' => '<h3 class="widgettile">',
            'after_title' => '</h3>'
        );
        register_sidebar( $sidebar );

    }
    add_action('init','thanhlam_theme_setup');
}
//  TEMPLATE FUNCTIONS
if(!function_exists('thanhlam_header')){
    function thanhlam_header(){ ?>
        <div class="site-name">
            <?php
                if( is_home()){
                    printf('<h1><a href="%1$s" title="%2$s">%3$s</h1>',
                    get_bloginfo('url'),
                    get_bloginfo('description'),       
                    get_bloginfo('sitename')                  
                    );
                } else {
                    printf('<p><a href="%1$s" title="%2$s">%3$s</p>',
                    get_bloginfo('url'),
                    get_bloginfo('description'),       
                    get_bloginfo('sitename')   
                    );
                }         
            ?>
        </div>
        <div class="site-description"><?php bloginfo('description'); ?></div>
        <?php
    }
};
// thieets lap menu

if(!function_exists('thanhlam_menu')){
    function thanhlam_menu($menu){
        $menu = array(
            'theme_location' =>$menu,
            'container' => 'nav',
            'container_class' => $menu
        );
        wp_nav_menu( $menu );
    }
}

if(!function_exists('thanhlam_pagination')){
    function thanhlam_pagination(){
        if($GLOBALS['wp_query']->max_num_pages <2) {
            return '';
        }?>
        <nav class="pagination" role="navigation">
            <?php if(get_next_posts_link()): ?>
            <div class="prev">
                <?php next_posts_link(__('Older Posts','thanhlam')); ?>
            </div>
            <?php endif; ?>
            <?php if (get_previous_posts_link()) : ?>
                <div class="next">
                    <?php previous_posts_link(__('Newest Posts','thanhlam')) ?>
                </div>
            <?php endif ?>

        </nav>
        <?php
    }
}

// hien thi thumbnail
if(!function_exists('thanhlam_thumbnail')){
    function thanhlam_thumbnail($size){
        if(!is_single() && has_post_thumbnail() && !post_password_required() || has_post_format('image')) : ?>
        <figure class="post-thumbnail">
            <?php the_post_thumbnail($size); ?>
        </figure>
        <?php endif ?>
        <?php
    }
}

// ham thanhlam_entry_header
if(!function_exists('thanhlam_entry_header')){
    function thanhlam_entry_header(){ 
        if(is_single()) :?>
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a>
            </h1>
        <?php else :?>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                <?php the_title(); ?>
                </a>
            </h2>
        <?php endif ?>
            <?php
    }
}

// ham thanhlam_entry_meta
if(!function_exists('thanhlam_entry_meta')){
    function thanhlam_entry_meta(){ ?>
    <?php if(!is_page()) : ?>
        <div class="entry-meta">
            <?php
            printf(__('<span class="author">Posted by %1$s</span>','thanhlam'),get_the_author());
            printf(__('<span class="date-published">at %1$s</span>','thanhlam'),get_the_date());
            printf(__('<span class="category">in %1$s</span>','thanhlam'),get_the_category_list(','));
            if(comments_open()):
                echo '<span class="meta-reply">';
                comments_popup_link(__('Leave a comment','thanhlam'), __('One comment','thanhlam'), __('% commment','thanhlam'), __('Read all comments','thanhlam'));
                echo '</span>';
            endif;
            ?>
        </div>
        <?php endif; ?>

    <?php }
}
if(!function_exists('thanhlam_entry_content')){
    function thanhlam_entry_content(){
        if(!is_single()) {
            the_excerpt();
        } else {
            the_content();
            $link_pages = array(
                'before'=> __('<>Page: ','thanhlam'),
                'after' =>'</p>',
                'nextpagelink' => __('Next Page','thanhlam'),
                'previouspagelink' =>__('Previous Page Link', 'thanhlam')
            );
            wp_link_pages($link_pages);
        }
    }
}
function thanhlam_readmore(){
    return '<a class="read-more" href="'. get_permalink(get_the_ID()) .'">'.__('[Read More]','thanhlam').'</a>';
}
add_filter('excerpt_more','thanhlam_readmore');


function thanhlam_entry_tag(){
    if(has_tag()) :
        echo '<div class="entry-tag"></div>';
        printf(__('Tagged in %1$s','thanhlam'),get_the_tag_list('', ','));
        echo '</div>';
    endif;
}


