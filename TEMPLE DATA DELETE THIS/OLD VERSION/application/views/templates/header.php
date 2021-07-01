<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title><?php echo $title; ?></title>

    <!-- Bootstrap -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- My style -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <link rel="icon" type="image/jpg" href="/assets/img/general/icon.webp">


    <?php
      function isA($active_name, $value)//is Active//<?php isA($a, 0); ?/>
      {
        if ($active_name == $value) echo " active"; 
      }
      $a = $active_name;
    ?>
    
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <header class="fixed">
      <div class="container-fluide">
        <div class="wrapper">
          <div class="nav-title">
            <div class="logo">
              <a href="/"><img src="/assets/img/general/TH.webp" title="TRENDY HALL"></a>
            </div>
          </div> 
          <nav>
            <ul>
              <li class="cat<?php isA($a, 0); ?>"><a href="/">Главная</a></li>
              <li class="cat<?php isA($a, 1); ?>"><a href="/news/">Новости</a></li>
              <li class="cat<?php isA($a, 2); ?>"><a href="/brands/">Бренды</a></li>
              <li class="cat<?php isA($a, 3); ?>"><a href="/man/">Мальчики</a></li> 
              <li class="cat<?php isA($a, 4); ?>"><a href="/woman/">Девочки</a></li> 
              <li class="cat<?php isA($a, 5); ?>"><a href="/new/">Новинки</a></li>
              <li class="cat<?php isA($a, 6); ?>"><a href="/sale/">Скидки</a></li>
            </ul>

          </nav> 
          <div class="nav-right">

            <div class="search icon icon-search hidden-xs hidden-sm">
              <svg fill='none' height='50' width='50' xmlns='http://www.w3.org/2000/svg'>
                <path clip-rule='evenodd' d='M15.483 17.735a9.463 9.463 0 000 13.435c3.61 3.61 9.013 4.072 13.074.346l4.604 4.603.707-.707-4.604-4.603c3.727-4.062 3.264-9.465-.346-13.074a9.463 9.463 0 00-13.435 0zm.707 12.728a8.463 8.463 0 010-12.021 8.463 8.463 0 0112.021 0c3.354 3.353 3.68 8.34 0 12.02-3.68 3.681-8.667 3.354-12.02 0z' fill='#000' fill-rule='evenodd'/>
              </svg>
            </div> 
            <div class="icon icon-cart" data-qty="0">
              <svg viewBox='0 0 50 50' xmlns='http://www.w3.org/2000/svg'>
                <path clip-rule='evenodd' d='M20.9 17.7c0-.6.2-1.6.7-2.3S23 14 24.5 14s2.4.6 2.9 1.4c.6.8.7 1.7.7 2.3v2h-7.4v-2zm-1 2v-2c0-.8.2-1.9.9-2.9s1.9-1.8 3.8-1.8 3 .8 3.8 1.8c.7 1 .9 2.1.9 2.9v2H32.5l.1.4L35 35.2l.1.6H14l.1-.6 2.5-15.1.1-.4h.4zm-4.7 15.1l2.3-14.1h14.2L34 34.8z' fill-rule='evenodd'/>
              </svg>
            </div> 
            <div class="icon icon-profile">
              <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="bi bi-person-circle" viewBox="0 0 25 25">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </div>
            <div class="icon icon-profile visible-xs">
              <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle" aria-controls="navbarCollapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
          </div>
          
        </div>
      </div>
      <div id="navbarCollapse" class="hidden-md hidden-lg collapse navbar-collapse">
            <ul class="nav nav-justified">
              <li class="cat<?php isA($a, 0); ?>"><a href="/">Главная</a></li>
              <li class="cat<?php isA($a, 1); ?>"><a href="/news/">Новости</a></li>
              <li class="cat<?php isA($a, 2); ?>"><a href="/brands/">Бренды</a></li>
              <li class="cat<?php isA($a, 3); ?>"><a href="/man/">Мальчики</a></li> 
              <li class="cat<?php isA($a, 4); ?>"><a href="/woman/">Девочки</a></li> 
              <li class="cat<?php isA($a, 5); ?>"><a href="/new/">Новинки</a></li>
              <li class="cat<?php isA($a, 6); ?>"><a href="/sale/">Скидки</a></li>
            </ul>
          </div>
     </header>


  <div class="container content">
      <div class="row">
        <!-- Content -->
          
          <!-- ============= -->
          <!-- Start content -->




