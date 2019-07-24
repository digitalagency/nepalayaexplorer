<?php
/**
 * Template Name: Page Right Sidebar
 * The main template file for display page.
 *
 * @package WordPress
 */
/**
 *    Get Current page object
 **/
$page = get_page($post->ID);
/**
 *    Get current page id
 **/
$current_page_id = '';
if (isset($page->ID)) {
    $current_page_id = $page->ID;
}
$page_style = 'Right Sidebar';
$page_sidebar = get_post_meta($current_page_id, 'page_sidebar', true);
if (empty($page_sidebar)) {
    $page_sidebar = 'Page Sidebar';
}
get_header();
?>
<br class="clear"/>
<?php
//Include custom header feature
get_template_part("/templates/template-header");
?>
<div class="inner">
    <!-- Begin main content -->
    <div class="inner_wrapper">
        <div class="sidebar_content full_width nopadding">
            <div class="sidebar_content">
                <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                    <?php the_content(); ?>
                <?php endwhile; ?>
                <br class="clear"/><br/><br/>
            </div>
            <div class="sidebar_wrapper">
                <div class="sidebar">
                    <div class="content">
                        <?php $pageTitle = get_the_title(); ?>
                        <?php if ($pageTitle == 'Nepal' || $pageTitle == 'Myanmar') { ?>
                            <ul class="sidebar_widget relatedpack">

                                <li class="widget">
                                    <h2 class="widgettitle trekking">Land</h2>
                                    <ul>
                                        <?php //$pageTitle?>
                                        <?php
                                        $arg1 = array(
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'tourcats',
                                                    'field' => 'slug', //can be set to ID
                                                    'terms' => 'trekking' //if field is ID you can reference by cat/term number
                                                )
                                            ),
                                            'meta_query' => array(
                                                array('key' => 'tour_country',
                                                    'value' => $pageTitle
                                                )
                                            ),
                                            'post_type' => 'tours',

                                        );
                                        $wp_query = new wp_query($arg1);
                                        if ($wp_query->have_posts()):

                                            while ($wp_query->have_posts()):
                                                $wp_query->the_post();
                                                echo '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
                                            endwhile;
                                        endif;
                                        wp_reset_query();
                                        ?>
                                    </ul>
                                </li>
                                <li class="widget">
                                    <h2 class="widgettitle rafting">River</h2>
                                    <ul>
                                        <?php
                                        $arg2 = array(
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'tourcats',
                                                    'field' => 'slug', //can be set to ID
                                                    'terms' => 'rafting' //if field is ID you can reference by cat/term number
                                                )
                                            ),
                                            'meta_query' => array(
                                                array('key' => 'tour_country',
                                                    'value' => $pageTitle
                                                )
                                            ),
                                            'post_type' => 'tours',

                                        );
                                        $wp_query1 = new wp_query($arg2);
                                        if ($wp_query1->have_posts()):
                                            while ($wp_query1->have_posts()):
                                                $wp_query1->the_post();
                                                echo '<li><a href="' . get_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></li>';
                                            endwhile;
                                        endif;
                                        wp_reset_query();
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <ul class="sidebar_widget">
                                <?php dynamic_sidebar($page_sidebar); ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
                <br class="clear"/>

                <div class="sidebar_bottom"></div>
            </div>
        </div>
    </div>
    <!-- End main content -->
</div>
</div>
<br class="clear"/>
<?php get_footer(); ?>