<?php
/*
	Template Name: Front-page
*/
?>

<?php get_header(); ?>

<div class="galeria container">
  <div class="row">

    <div class="col-lg-12 transf" style="transform: translateX(-15.5px);">
      <div class="baner-strona" style="overflow:hidden;
      height:15em;background-image:url(https://i.imgur.com/7re1o2O.jpg);
      background-size:20%;background-repeat:repeat;background-attachment:fixed;">
      </div>

      <div style="position:relative; left:-50%; z-index: 20; width:100%;">
        <h2 style="color:white!important;position:absolute; left:50%; width:100%;text-align:center;
        text-transform: uppercase;top:-23vh; background-color:rgba(0,0,0,0.7)"> MIŁOSZ SZATKOWSKI
      </h2>
      </div>
    </div>

    <style media="screen">
    #zaslona{height: 2em !important;}
    #nav-menu{display: none !important;}
    ul{
      list-style-type: none !important;
    }
    ul li{display: inline-block;padding:1em;font-size:1.5em;}
      @media screen and (max-width:600px){
        .transf{transform: translateX(0)!important;}
      }
    </style>

    <div class="col-lg-12 pad1em row">
      <div class="cont1 col-lg-12 pad1em">

        <h4 class="">O MNIE</h4>
        <p>Nazywam się <strong>Miłosz Szatkowski</strong> i jestem grafikiem komputerowym oraz artystą.</p>
        <p>Zapraszam do zapoznania się z moją stroną:</p>

        <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>

        </div>
      </div>


    <div class="col-lg-12 pad1em row">
      <div class="cont1 col-lg-12">
        <h4 class="col-md-12 pad1em">Chmura kategorii projektowania:</h4>
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
          'child_of'                  => 19, // see Note!
        );
        wp_tag_cloud( $args ); ?></p>
      </div>
    </div>

    <div class="col-lg-12 pad1em row">
      <div class="cont1 col-lg-12">
        <h4 class="col-md-12 pad1em">Chmura kategorii sztuki:</h4>
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

    <div class="col-lg-12 text-center mar-top">
      <h4>Galeria losowych zdjęć:</h4>
      <p>Generowana podczas ładowania strony.</p>
    </div>


    <div class="col-lg-12 row mar-top">
      <?php $query_images_args = array(
            'post_type'      => 'attachment',
            'post_mime_type' => 'image',
            'post_status'    => 'inherit',
            'posts_per_page' => - 1,
        );

        $query_images = new WP_Query( $query_images_args );

        $images = array();
        foreach ( $query_images->posts as $image ) {
            $images[] = wp_get_attachment_url( $image->ID );
        }

        $counterImg = array();

        for ($i=0; $i < 6; $i++) {
          array_push($counterImg, random_int(0,count($images)));
        }

        $iind = 0;
        while ($iind < count($counterImg)) {

          ?>

          <div class="pad1em col-lg-6">
            <div class=""
            style="height:300px;background-image:url(<?=$images[$counterImg[$iind]]?>);
            background-color:grey;background-size:contain; background-repeat:no-repeat;
            background-position:center;padding:1em;">

            </div>
          </div>


          <?php     $iind++;  }   ?>

    <h3 class="col-md-12 text-center mar-top pad1em">Archiwum projektów:</h3>

  <div class="col-lg-12 row">

    <?php
    $args = array( 'post_type' => array('design','art'), 'posts_per_page' => 50 , 'orderby' => 'name', 'order'     => 'ASC',);
    $loop = new WP_Query( $args );

    $ind = 0;
    while ( $loop->have_posts() ) : $loop->the_post();?>

    <?php

    $images = acf_photo_gallery('galeria', $post->ID);
    $thumb =  $images[0]['thumbnail_image_url'];

    ?>

    <a href="<?php echo the_permalink();?>" class="d-block pad1em col-lg-6 col-xs-12" style="width:100%;">
            <img src="<?=$thumb?>" alt="" style="max-width:60px;width:100%;margin:0 auto;
              box-shadow: 1px 1px 5px rgba(0,0,0,0.5); border-radius:50%; display:inline-block;">
              <?php echo the_title() ;?>
    </a>

    <?php $ind++; endwhile; ?>

  </div>

  </div>

      <!-- koniec row -->
  </div>
  <!-- koniec kont -->
</div>
<?php get_footer(); ?>
