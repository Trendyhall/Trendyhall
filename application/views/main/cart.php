
<div class="row">
    <div class="col col-12 col-sm-8" id="cartCardsContainer">
        
    </div>
    <div class="col col-12 col-sm-4">
        cart
        <div id="cartTest"></div>
        <script>
            document.getElementById('cartTest').innerHTML = JSON.stringify(localStorage.getItem("cart"), null, 2);

        </script>
         <br>
        <?php 
        echo 'UserID: '.$this->data['UserID']; ?>
        <br>
        <button class="btn btn-outline-dark" id="addToCart">Заказать</button>
    </div>
</div>