<?php get_header(); ?>

    <div class="wrap_1280">

        <div class="main-content " style="margin-top:2em;">
          <?php
          $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
          $parts=parse_url($actual_link);
          $str = $parts['path'];
          $exp = explode('/', $str);
          $id = $exp[count($exp)-2]; ?>

           <div class="container" style="pad1em" >
             <div class="row">
               <div class="col-md-6 ">
                <h4>Oglądasz posty z kategori:</h3><h3><?=$id?></h3>
                  <p></p>
               </div>
               <div class="col-md-6 ">
                 <h3>Zobacz też:</h3>
                 <?php
                  $id2 = get_cat_ID($id);
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
                  );
                  wp_tag_cloud( $args );  ?>
               </div>
               <div class="col-md-12 row cont1">
                 <?php $query = new WP_Query(  array( 'category_name' => $id, 'post_type' => array('design', 'art') )  );
                  if ( $query->have_posts() ) : ?>
                    <?php while ( $query->have_posts() ) : $query->the_post();
                    $images = acf_photo_gallery('galeria', $post->ID);
                    $thumb =  $images[0]['thumbnail_image_url'];
                    ?>
                    <a href="<?=the_permalink();?>" class="pad1em d-block col-lg-2 col-md-2 col-sm-3 col-xs-4 col-12">
                      <div>
                        <img src="<?=$thumb?>" alt="">
                        <h5><?php the_title(); ?></h5>
                      </div>
                    </a>
                    <?php endwhile; wp_reset_postdata(); ?>
                  <!-- show pagination here -->
                  <?php else : ?>
                    <!-- show 404 error here -->
                  <?php endif; ?>
               </div>

             </div>

           </div>



        </div><!-- END MAIN-CONTENT -->

    </div><!-- END wrap_1280 -->

<?php get_footer(); ?>
