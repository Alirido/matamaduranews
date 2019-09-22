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
<div class="headline ovh" id="headline"  >
    <div id="slideshow" class="clsslide" style="z-index:0">
        <?php
        while( $query->have_posts() ) {
            $query->the_post();
            $excerpt_text = short_by_word( get_the_excerpt(), 20 );
            $img_src = wp_get_attachment_image_src( get_post_thumbnail_id( $GLOBALS['post']->ID ), 'post-slider-medium' );
            if($img_src[0]!='') {
                $thumbnail = $img_src[0];
            }
            else {
                $thumbnail = get_template_directory_uri().'/images/no-image-available.png';
            }
            ?>
            <div class="mySlide fade" style="z-index:9999">
                <a style="display:block" href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                    <img src='<?php echo $thumbnail; ?>' height='493' width='735' class='al' alt='<?php echo get_the_title(); ?>' />
                </a>
                <div class="ovh hlover" >
                    <div class="pt5"></div>
                    <h2 class="hlover_title"><a href="<?php echo get_permalink(); ?>" title="<?php echo get_the_title(); ?>" class="txt-oev-2"><?php echo get_the_title(); ?></a></h2>
                </div>
            </div>
        <?php } ?>
        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
    <script>
        var slideIndex = 0;
        showSlides();

        // Next/previous controls
        function plusSlides(idx) {
            showSlides(slideIndex += idx);
        }

        function showSlides(idx) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("dot");
            if (idx > slides.length) {slideIndex = 1}
            if (idx < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
        }

        function showSlides() {
            var i;
            var slides = document.getElementsByClassName("mySlide");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}
            slides[slideIndex-1].style.display = "block";
            setTimeout(showSlides, 5000); // Change image every 5 seconds
        }
    </script>
</div>
