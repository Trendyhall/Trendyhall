<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------

if ( ! function_exists('get_price'))
{
	function get_price($price, $sale = 0){
        return number_format($price * (0.01 * (100 - $sale)), 0,"."," ");
    }
}

if ( ! function_exists('get_price_text'))
{
    function get_price_text($good){
        if ($good['sale'] == 0): ?>
            <div class="card-price"><?php echo get_price($good['price']); ?> ₽</div>
        <?php endif; ?>
        <?php if ($good['sale'] > 0): ?>
            <div class="card-price-lined"><?php echo get_price($good['price']); ?> ₽</div>
            <div class="card-price card-price-red"><?php echo get_price($good['price'], $good['sale']); ?> ₽</div>
        <?php endif; 
    }
}


if ( ! function_exists('get_card'))
{
    function get_card($good){?>
                <div class="col position-relative">
                    <button class="btn like" data-like-id="<?php echo $good['id']; ?>"></button>
                    <a href="/goods/<?php echo $good['id']/*.'|'.$good['name']*/; ?>">
                        <div class="card h-100">
                            <img src="<?php get_image_href($good);?>" class="card-img-top" alt="<?php echo $good['name']; ?>">
                            <?php if ($good['sale'] != 0): ?>
                                <div class="sale-lable">-<?php echo $good['sale'] ?>%</div>
                            <?php endif; ?>
                            <div class="card-body">
                                <div class="card-name"><?php echo $good['name']; ?></div>
                                <div class="card-brand"><?php echo $good['brand']; ?></div>
                                <?php get_price_text($good); ?>
                            </div>
                        </div>
                    </a>
                </div>
                <?php 
    }
}

if ( ! function_exists('get_image_href'))
{
    function get_image_href($good, $number = FALSE){
        if ($number !== FALSE)
        { // ALTERNATE
            if ($good['imagecount'] == 0) 
                { 
                    echo "/assets/img/general/noimage.webp"; 
                } 
                else 
                { 
                    echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Alternate/".$good['id']."_$number.webp"; 
                }
        }
        else
        { // MAIN
            if ($good['imagecount'] == 0) 
                { 
                    echo "/assets/img/general/noimage.webp"; 
                } 
                else 
                { 
                    echo "https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/".$good['id'].".webp"; 
                }
        }
    }
}

if ( ! function_exists('view_echo'))
{
    function view_echo($loader, $content){
        $loader->view('templates/echo', array("echo" => $content));
    }
}