<?php
$query->the_post();
$excerpt_text = short_by_word( get_the_excerpt(), 1 );
$img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'post-slider-medium' );
if($img_src[0]!='') {
    $thumbnail = $img_src[0];
}
else {
    $thumbnail = get_template_directory_uri().'/images/no-image-available.png';
}
?>
<div class="mySlide" style="display: block">
    <a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
        <img src='<?php echo $thumbnail; ?>' width="100%" height="100%" alt='<?php echo get_the_title(); ?>' />
    </a>
    <div class="hlover" >
        <div class="pt5"></div>
        <h2 class="hlover_title f14" style="margin-bottom: 0px;font-size: 14px; line-height: 120%"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="txt-oev-2"><?php echo get_the_title(); ?></a></h2>
    </div>
</div>
