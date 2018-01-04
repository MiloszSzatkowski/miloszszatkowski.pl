
<?php get_header(); ?>

<style media="screen">
  .cat-links{display:none;}
</style>

<section id="content" role="main">

<article class="container">

<div class="row">

  <div class="col-sm-12 text-center">
    <p></p>
    <h2>Kontakt</h2>
  </div>

  <div class="col-sm-12 text-center">
    <p><img src="http://miloszszatkowski.pl/wp-content/uploads/2017/11/zdj-portret.jpg"
    class="circle sepia com-sm-12"
    style="border-left:5px solid red;border-bottom:5px solid red;width:100%;width:10em;filter:sepia(0.7);"/>
    </p>

  </div>

  <div class="col-sm-12 text-center">

    <h6>Zapraszam do kontaktu telefonicznie lub przez formularz:</h6>

     <h5 class="" style="">
       <a href="tel:511349113">
        <i class="fa fa-mobile " aria-hidden="true"> </i>
        511 349 113
      </a></h5>

  </div>

  <div class="col-sm-12">
    <p></p>
    <h3 class="text-center">Formularz kontaktowy</h3>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php get_template_part( 'entry' );?>
    <?php endwhile; endif; ?>
  </div>

</div>



</article>

</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
