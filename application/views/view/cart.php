
<div class="row">
    <div class="col col-12 col-sm-8" id="cartCardsContainer">
        <div class="w-100 d-flex justify-content-center align-content-center">
            <div class="spinner-border" style="width: 5rem; height: 5rem; margin: auto;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="col col-12 col-sm-4">
        <div class="overflow-auto" id="cartTest">
            <div class="w-100 d-flex justify-content-center align-content-center">
                <div class="spinner-border" style="width: 5rem; height: 5rem; margin: auto;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
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