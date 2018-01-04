<?php
/*
	Template Name: Projektowanie
*/
?>
<?php get_header(); ?>

<div class="" style="height:20em; background-color:blue;">

</div>

<div class="galeria container">
  <div class="row">

    <div class="col-md-12 text-center font-italic mar-top" style="font-weight:300;font-size:0.8em;">
      <i class="fa fa-commenting" aria-hidden="true"></i> Najbardziej interesuje mnie zgodność z technicznymi wymaganiami projektu. <br>
      Stawiam sobie za cel funkcjonalność, której podporządkowuje wygląd.
    </div>
    <h3 class="col-md-12 text-center mar-top">Moje projekty:</h3>


<?php
$args = array( 'post_type' => 'projektowanie', 'posts_per_page' => 20 );
$loop = new WP_Query( $args );

$ind = 0;
while ( $loop->have_posts() ) : $loop->the_post();?>

<?php

$images = acf_photo_gallery('galeria', $post->ID);
$thumb =  $images[0]['thumbnail_image_url'];

?>

<a href="<?php echo the_permalink();?>" class="thumb-cont col-lg-3 col-md-4 col-sm-4 col-xs-6 col-6 d-block">
<div class="">
    <div class="thumb-wrap pad1em" style="background-color: <?php if($ind%2==0){echo '#303030';}else{echo '#323d3f';}?>;
      border-top: 0.2em solid <?php if($ind%2==0){echo '#323d3f';}else{echo '#303030';}?>">
      <h6>
        <?php echo the_title() ;?>
      </h6>
      <div id="thumb_<?=$ind?>" class="thumb">

      </div>
    </div>
  </div>
</a>
<style media="screen">

.thumb-wrap{

}

#thumb_<?=$ind?>{
  height:9em;
  transition: all 0.5s linear;
  background-position: center;
  background-size: contain;
}

@media (max-width:500px) {
  #thumb_<?=$ind?>{
    height:5em;
  }
}

#thumb_<?=$ind?>::before, #thumb_<?=$ind?>::after{
  content: " ";
  box-shadow: 0 0 2px black;
  background-image: url(<?=$thumb?>);
  background-position: center;
  background-size: 80%;;
  width: 60%;
  height: 60%;
  display: flex;
  position: absolute;
  border: 2px solid grey;
  /*left: 0%;*/
  }
/* the blurred image */
<?php $g = '2px'; ?>
#thumb_<?=$ind?>::before{
  content: " ";
  display: flex;
  position: absolute;
  background-repeat: repeat;
  overflow: hidden;
  -webkit-filter: blur(<?=$g?>) grayscale(100%);
  -moz-filter: blur(<?=$g?>);
  -o-filter: blur(<?=$g?>);
  -ms-filter: blur(<?=$g?>);
  filter: blur(<?=$g?>) gray;
  }
/* the clear image */
#thumb_<?=$ind?>::after{
  content: " ";
  -webkit-filter: grayscale(60%);
  filter: grayscale(60%);
  background-repeat: no-repeat;
  z-index: 1;
  }

</style>


<?php $ind++; endwhile; ?>

<style media="screen">

</style>

</div></div>

</section>

<?php get_footer(); ?>
