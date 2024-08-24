<?php

$post_id = get_the_ID();

$item_classes = 'all ';

$post_category = '';
$separator = ', ';
$output = '';

$item_cats = get_the_terms(get_the_ID(), 'category_portfolio');



if (!empty($item_cats) && !is_wp_error($item_cats)) {

    foreach ((array)$item_cats as $item_cat) {

        $item_classes .= $item_cat->slug . ' ';

        $output .= '<a href="' . get_category_link($item_cat->term_id) . '" title="' . esc_attr(sprintf(esc_attr__("View all posts in %s", 'conult'), $item_cat->name)) . '">' . $item_cat->name . '</a>' . $separator;
    }

    $post_category = trim($output, $separator);
}

$thumbnail = 'conult_medium';

if (isset($thumbnail_size) && $thumbnail_size) {

    $thumbnail = $thumbnail_size;
}

if (isset($layout) && $layout && $layout == 'grid') {

    $item_classes .= ' item-columns isotope-item';
}



$desc = '';

$excerpt_words = (isset($excerpt_words) && $excerpt_words) ? $excerpt_words : 30;

if (has_excerpt()) {

    $desc = conult_limit_words($excerpt_words, get_the_excerpt(), '');
}



?>

<div class="<?php echo esc_attr($item_classes) ?>">

    <div class="portfolio-block portfolio-v3">

        <div class="portfolio-post-thumbnail">

            <a href="<?php echo esc_url(get_permalink()) ?>">

                <?php the_post_thumbnail($thumbnail, array('alt' => get_the_title())); ?>

            </a>


        </div>

        <div class="case-content">

            <div class="portfolio-content-inner">

                <h3 class="portfolio-entry-title"><a class="portfolio-title-ref" href="<?php echo esc_url(get_permalink()) ?>" rel="bookmark"><?php the_title() ?></a></h3>

                <?php if ($desc) { ?>

                    <div class="portfolio-entry-desc">

                        <?php echo esc_html($desc) ?>

                    </div>

                <?php } ?>

                <div class="portfolio-read-more">

                    <a class="btn-portfolio-inline btn-read-more" href="<?php echo esc_url(get_permalink()) ?>"><?php echo esc_html__('Read more', 'conult'); ?><i class="las la-arrow-right"></i></a>

                </div>



            </div>

        </div>

    </div>


</div>