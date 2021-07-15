
<div class="row">
    <div class="col col-12 col-sm-8">
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4" id="cartCardsContainer">
    
        </div>
    </div>
    <div class="col col-12 col-sm-4">
        cart
        <div id="cartTest"></div>
        like
        <div id="likeTest"></div>
        <script>
            document.getElementById('cartTest').innerHTML = JSON.stringify(localStorage.getItem("cart"), null, 2);
            document.getElementById('likeTest').innerHTML = JSON.stringify(localStorage.getItem("like"), null, 2);

        </script>
         <br>
        <?php 
        echo 'UserID: '.$this->data['UserID']; ?>
        <br>
        <button class="btn btn-outline-dark" id="addToCart" style="border-radius: 0;">Заказать</button>
    </div>
</div>