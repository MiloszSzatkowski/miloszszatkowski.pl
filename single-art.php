<?php
/*
	Template Name: Sztuka - post
*/
?>

<?php get_header(); ?>

<style media="screen">
  #content section{padding:1em;padding-top:0.5em;}
  @media (max-width:700px){#content section{padding:0.3em;}}

</style>

<section id="content" role="main" class="container mar-top">
  <section class="row">

    <section class="col-md-8">
      <section class="cont1">
        <h2 class=""><?=the_title();?></h2>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'entry' );?>
        <?php endwhile; endif; ?>
      </section>
    </section>

    <section class="col-md-4">
      <section class="cont1 row">
      <h4 class="col-md-12">Chmura kategorii:</h4>
      <p class="col-md-12"><?php
      $args = array(
        'smallest'                  => 10,
        'largest'                   => 12,
        'unit'                      => 'pt',
        'number'                    => 0,
        'format'                    => 'flat',
        'separator'                 => "<br>",
        'orderby'                   => 'name',
        'order'                     => 'ASC',
        'exclude'                   => null,
        'include'                   => null,
        'topic_count_text_callback' => default_topic_count_text,
        'link'                      => 'view',
        'taxonomy'                  => 'category',
        'echo'                      => true,
        'child_of'                  => 20, // see Note!
      );
      wp_tag_cloud( $args ); ?></p>
      <hr class="col-md-8">
      <h4 class="col-md-12">Inne moje projekty:</h4>

      <?php
      $args = array( 'post_type' => 'art', 'posts_per_page' => 20, 'post__not_in' => array( $post->ID ) );
      $loop = new WP_Query( $args );
      while ( $loop->have_posts() ) : $loop->the_post();?>
      <?php
      $images = acf_photo_gallery('galeria', $post->ID);
      $thumb =  $images[0]['thumbnail_image_url'];?>

      <div class="row col-md-12 thumb-wrap" style="margin:0.5em 0 1em 0;">
        <a href="<?=the_permalink();?>" class="col-md-12 d-inline-block" style="margin-top:0.5em;">
          <img src="<?=$thumb?>" alt="" style="max-width:100%;height:4em;">
          </a>
          <a href="<?=the_permalink();?>" class="col-md-12 d-inline-block">
            <span class="">
            <?=the_title();?>
          </span></a>
      </div>


      <?php endwhile;  ?>
      <p></p>
      <a href="http://miloszszatkowski.pl/index.php/projektowanie/" class="cont2 pad1em d-block col-md-12">
        <i class="fa fa-backward" aria-hidden="true"></i> Wróć do widoku kategorii.</a>
      </section>
    </section>

  </section>
</section>

<?php get_footer(); ?>

<script type="text/javascript">

</script>
