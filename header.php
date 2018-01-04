<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Pridi" rel="stylesheet">

<script src="https://use.fontawesome.com/9c4a6d22fb.js"></script>

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous"> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script> -->

<?php wp_head(); ?>
</head>
<div class="se-pre-con"></div>
<body <?php body_class(); ?>>

<div id="wrapper" class="hfeed">

<header id="header" role="banner">

<section id="branding">

<div id="site-title">
</div>

<div class="">
  <div id="site-description">
  </div>

  </section>

  <nav id="nav-menu" role="navigation" style="display:block;">

  <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
  </nav>

  <nav id="zaslona" style="display:block; position: static; height: 4em;">

  </nav>
</div>

<p id="home-url" style="display:none;"><?php echo get_home_url(); ?></p>

<script type="text/javascript">
jQuery(function ($) {
  $(document).ready(function(){
    $(".se-pre-con").fadeOut("slow");
    $('.current-menu-item a').html(

      '<i class="fa fa-ravelry" aria-hidden="true"></i>' +
      $('.current-menu-item a').text() +
      '<i class="fa fa-ravelry" aria-hidden="true"></i>');

    $('#menu-menu').after('<p id="me-tekst" style="padding:1em;padding-right:2em;float:right;font-size:x-small;display:inline-block;">Miłosz Szatkowski</p>');
    $('#menu-menu').before('<a class="h-icons" href=' + '"' + $('#home-url').text() +
    ' " style="float:left; padding-right:1em;"><i class="fa fa-home" aria-hidden="true" style="color:inherit"></i></a>');
    $('#menu-menu').before('<a class="h-icons" href="mailto:milosz.dawid.szatkowski@gmail.com" style="float:left; padding-right:1em;"><i class="fa fa-envelope-o" aria-hidden="true" style="color:inherit"></i></a>');

    if ($('.tag-cloud-link').length) {
      var ll = $('.cont1 p a').toArray();
      var division;
      for (var i = 0; i < ll.length; i++) {
        division = i/3;
        if (i===0) {
            $('.tag-cloud-link').eq(i).css('color', 'hsl(231.1, 50%, 55%)');
        } else {
            $('.tag-cloud-link').eq(i).css('color', 'hsl(' + 231/division + ',50%,55%)');
        }
      }
    }

      });
  });

</script>

</header>
<style media="screen">
.no-js #loader { display: none;  }
.js #loader { display: block; position: absolute; left: 100px; top: 0; }
.se-pre-con {
  <?php if ($page!==false || is_front_page()){ echo 'display:none';} ?>
position: fixed;left: 0px;top: 0px;width: 100%;height: 100%;z-index: 9999;background: url('https://i.imgur.com/iYBMZOj.gif') center no-repeat #fff;}
.entry-meta, .post-edit-link {
  display: none;}
  ul {list-style-type: disc !important;
      padding-left: 2em;  }
  ol {list-style-type: decimal !important;
      padding-left: 2em;  }
  em{font-style: italic!important;}
</style>
<!-- <div id="container"> -->
