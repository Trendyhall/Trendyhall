
<script src="/assets/js/cart.js"></script>
<div class="row">
    <div class="col col-12 col-sm-8">
        <a href="/goods/IU0IU00137_BEH">
            <div class="card border-dark text-start mb-3" style="border: solid 1px;">
              <div class="row g-0">
                <div class="col-md-3">
                  <img src="https://raw.githubusercontent.com/Trendyhall/GoodsPictures/main/Main/id1.webp" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-9">
                  <div class="card-body">
                    <h5 class="card-title">Рюкзак</h5>
                    <p class="card-text">Calvin Klein Jeans</p>
                    <p class="card-text">8 909.00 ₽</p>
                    <div class="mb-3">
                        <button class="btn btn-outline-dark" id="addToCart" style="border-radius: 0;">Убрать</button>
                        <button class="btn btn-outline-dark" id="addToCart" style="border-radius: 0;">Изменить</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </a>        

        
        
    </div>
    <div class="col col-12 col-sm-4">
        cart
        <div id="cartTest"></div>
        <script>
            localStorage.setItem('name', JSON.stringify({name: "John"}));
            document.getElementById('cartTest').innerHTML = JSON.stringify(localStorage, null, 2);

        </script>
         <br>
        <?php 
        echo 'UserID: '.$this->data['UserID']; ?>
        <br>
        <button class="btn btn-outline-dark" id="addToCart" style="border-radius: 0;">Заказать</button>
    </div>
</div>