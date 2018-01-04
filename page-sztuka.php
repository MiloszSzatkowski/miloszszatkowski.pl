<?php
/*
	Template Name: Sztuka
*/
?>

<?php get_header(); ?>

<div class="baner-strona" style="overflow:hidden;
height:15em;background-image:url(https://i.imgur.com/ZZo6HQ9.jpg);
background-size:44%;background-position:50%/50%; background-repeat:repeat;background-attachment:fixed;opacity:0.8;">
</div>

<div style="position:relative; left:-50%; z-index: 20; width:100%;">
  <h2 style="color:white!important;position:absolute; left:50%; width:100%;text-align:center;
  text-transform: uppercase;top:-23vh; text-shadow: 0px 0px 5px black"> <?php echo get_the_title(); ?>
</h2>
</div>

<div class="galeria container">
  <div class="row">

    <div class="col-md-12 text-center font-italic mar-top" style="font-weight:300;font-size:0.8em;">
      <i class="fa fa-commenting" aria-hidden="true"></i>
      Moja sztuka to sposób myślenia, dlatego niezależnie w jakim medium się manifestuje,<br>
      zawsze sprowadza się do tego, co kryje się poza obrazem.
    </div>

    <div class="col-lg-12 pad1em row">
      <div class="cont1 col-lg-12">
        <h4 class="col-md-12 pad1em">Chmura kategorii:</h4>
        <hr>
        <p class="col-md-12"><?php
        $args = array(
          'smallest'                  => 10,
          'largest'                   => 10,
          'unit'                      => 'pt',
          'number'                    => 0,
          'format'                    => 'flat',
          'separator'                 => " | ",
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
      </div>
    </div>


    <h3 class="col-md-12 text-center mar-top">Moje prace:</h3>

  <div class="col-lg-12 row">

    <?php
    $args = array( 'post_type' => 'art', 'posts_per_page' => 20 );
    $loop = new WP_Query( $args );

    $ind = 0;
    while ( $loop->have_posts() ) : $loop->the_post();?>

    <?php

    $images = acf_photo_gallery('galeria', $post->ID);
    $thumb =  $images[0]['thumbnail_image_url'];

    ?>

    <a href="<?php echo the_permalink();?>" class="thumb-cont col-lg-3 col-md-4 col-sm-4 col-xs-4 col-12 d-block">

        <div class="thumb-wrap pad1em" style="background-color: white; border-top: 0.2em solid #779da4">

          <h6>
            <?php echo the_title() ;?>
          </h6>

          <div id="thumb_<?=$ind?>" class="thumb">
            <img src="<?=$thumb?>" alt="" style="max-width:120px;width:100%;margin:0 auto;
            box-shadow: 1px 1px 5px rgba(0,0,0,0.5); border-radius:50%;">
          </div>

        </div>

    </a>

    <?php $ind++; endwhile; ?>

  </div>
      <!-- koniec row -->
  </div>
  <!-- koniec kont -->
</div>
<?php get_footer(); ?>
