<?php
global $tux_option;
$args = array (
    'posts_per_page'		=> $tux_option['tux_num_slider'],
    'post_status'			=> 'publish',
    'post__in' => get_option('sticky_posts'),
    'ignore_sticky_posts' => 1
);
$query = new WP_Query( $args );
?>
<div  style="width: 80%; margin: auto">
    <div class="cekheadline">
        <div class="checkout">
            <?php include 'headline_thumbnail.php'; ?>
        </div>
        <div class="checkout">
            <div class="cekheadline">
                <div class="checkout ">
                    <?php include 'headline_thumbnail_mini.php'; ?>
                </div>
                <div class="checkout">
                    <?php include 'headline_thumbnail_mini.php'; ?>
                </div>
            </div>
            <div class="cekheadline">
                <div class="checkout">
                    <?php include 'headline_thumbnail_mini.php'; ?>
                </div>
                <div class="checkout">
                    <?php include 'headline_thumbnail_mini.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
