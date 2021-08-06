<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <title><?php echo $title; ?></title>

    <!-- Bootstrap 
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- My style -->
    <link href="/assets/css/style.min.css" rel="stylesheet">
    <link href="/assets/css/templates-style.min.css" rel="stylesheet">
    
    <link rel="icon" type="image/webp" href="/assets/img/general/icon.webp">


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
              <a href="/"><img src="/assets/img/general/TH.webp" title="TRENDY HALL"></a>
          </div>
          <nav>
            <ul>
              <li class="cat<?php isA($a, 0); ?>"><a href="/">Главная</a></li>
              <li class="cat<?php isA($a, 1); ?>"><a href="/news">Новости</a></li>
              <li class="cat<?php isA($a, 2); ?>"><a href="/brands">Бренды</a></li>
              <li class="cat<?php isA($a, 3); ?>"><a href="/boys">Мальчики</a></li> 
              <li class="cat<?php isA($a, 4); ?>"><a href="/girls">Девочки</a></li> 
              <li class="cat<?php isA($a, 5); ?>"><a href="/new">Новинки</a></li>
              <li class="cat<?php isA($a, 6); ?>"><a href="/sale">Скидки</a></li>
            </ul>

          </nav> 

          <div class="nav-right">

            <button type="button" class="icon icon-search" onclick="location.href='/search'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
              </svg>
            </button> 
            <button type="button" class="icon icon-like" data-qty="" onclick="location.href='/like'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
              </svg>
            </button>
            <button type="button" class="icon icon-cart" data-qty="" onclick="location.href='/cart'">
              <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                <path d="m8,1a2.5,2.5 0 0 1 2.5,2.5l0,0.5l-5,0l0,-0.5a2.5,2.5 0 0 1 2.5,-2.5zm3.5,3l0,-0.5a3.5,3.5 0 1 0 -7,0l0,0.5l-3.5,0l0,14a2,2 0 0 0 2,2l10,0a2,2 0 0 0 2,-2l0,-14l-3.5,0zm-9.5,1l12,0l0,13a1,1 0 0 1 -1,1l-10,0a1,1 0 0 1 -1,-1l0,-13z"/>
              </svg>
            </button> 
            <button type="button" class="icon icon-profile" data-qty="" data-bs-toggle="modal" data-bs-target="#loginModal">
              <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" viewBox="0 0 16 16">
                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
              </svg>
            </button>
            <button class="navbar-toggle d-xs-block d-sm-none icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-expanded="false" aria-controls="collapseExample">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
              </svg>
            </button>
          </div>

        </div> 
      </div> 
      <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav nav-justified">
          <li class="cat<?php isA($a, 0); ?>"><a href="/">Главная</a></li>
          <li class="cat<?php isA($a, 1); ?>"><a href="/news">Новости</a></li>
          <li class="cat<?php isA($a, 2); ?>"><a href="/brands">Бренды</a></li>
          <li class="cat<?php isA($a, 3); ?>"><a href="/boys">Мальчики</a></li> 
          <li class="cat<?php isA($a, 4); ?>"><a href="/girls">Девочки</a></li> 
          <li class="cat<?php isA($a, 5); ?>"><a href="/new">Новинки</a></li>
          <li class="cat<?php isA($a, 6); ?>"><a href="/sale">Скидки</a></li>
        </ul>
      </div>
    </header>

    
    <!-- Modal -->
    <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Вход</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form name="login" class="needs-validation" method="post" action="" accept-charset="utf-8" novalidate>
              <div class="mb-3">
                <div class="form-floating mb-3">
                  <input type="text" name="phone" class="form-control" id="floatingPhone" placeholder="Номер телефона" required>
                  <label for="floatingPhone">Номер телефона</label>
                  <div class="invalid-feedback">Введите номер телефона</div>
                </div>
                <div class="form-floating">
                  <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Пароль" required>
                  <label for="floatingPassword">Пароль</label>
                  <div class="invalid-feedback">Введите пароль</div>
                </div>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" name="rememberme" class="form-check-input" id="remembermeCheck">
                <label class="form-check-label" for="remembermeCheck">Запомнить</label>
              </div>
              <div class="forgot-password mb-3">
                <a href="signup" class="">Зарегестрироваться</a> | <a href="reset-password" class="">Забыли пароль?</a>
              </div>
              <button type="submit" class="btn btn-outline-dark">Войти</button>
            </form>
          </div>
        </div>
      </div>
    </div>


    <!-- toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
      <div id="cartChangeToast" class="toast hide text-white bg-secondary" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="3000">
          <div class="d-flex">
        <div class="toast-body">
          Содержание корзины было изменено.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>


    <div class="container content">
          <!-- Content -->
            
            <!-- ============= -->
            <!-- Start content -->
