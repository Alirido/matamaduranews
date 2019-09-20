<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title></title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
  <?php wp_head();?>
</head>

<body>

    <p>tes</p>
    <?php get_header(); ?>
        <div class="row">
            <div class="col-sm-8 blog-main">

                <?php
                if ( have_posts() ) : while ( have_posts() ) : the_post();
            get_template_part( 'content', get_post_format() );
                endwhile; endif;
                ?>

            </div> 

            <?php get_sidebar(); ?>
        </div> 
    <?php get_footer(); ?>

</body>
</html>