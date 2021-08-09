
<div class="row">
    <div class="col col-12 col-sm-7" id="cartCardsContainer">
        <div class="w-100 d-flex justify-content-center align-content-center">
            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="col col-12 col-sm-5">
        <div class="overflow-auto mb-3" style="max-height: 60vh;" id="cartOverview">
            <div class="w-100 d-flex justify-content-center align-content-center">
                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <h4 class="mb-3"></h4>
        <div class="alert alert-danger d-flex align-items-center" role="alert">
          <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
          </svg>
          <div>
            Если ваш заказ лежит в корзине это не означает, что он отложен в магазине
          </div>
        </div>
        <button class="btn btn-outline-dark rounded-0 w-100 fs-4" id="BuyBtn" data-bs-toggle="modal" data-bs-target="#BuyModal">Заказать</button>
    </div>
</div>

<!-- Modal -->
    <div class="modal fade" id="BuyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Заказ</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form name="order" class="needs-validation" method="post" action="/cart" accept-charset="utf-8" novalidate>
                <input name="orderBody" type="text" hidden>
                <input name="passcode" type="text" hidden>
                <input name="ordertime" type="text" hidden>
                <div class="mb-3">
                    <div class="form-floating mb-2">
                        <input type="text" name="name" class="form-control" id="floatingN" placeholder="Фамилия Имя Отчество" required>
                        <label for="floatingN">Фамилия Имя Отчество</label>
                        <div class="invalid-feedback">Введите Фамилия Имя Отчество</div>
                        <p>Это нужно нам для обращения к вам</p>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" name="phone" class="form-control" id="floatingP" placeholder="Номер телефона" required>
                        <label for="floatingP">Номер телефона</label>
                        <div class="invalid-feedback">Введите номер телефона</div>
                        <p>Это нужно нам для возможности связаться с вами</p>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea name="comment" class="form-control" id="floatingC" placeholder="Комментарий" style="height: 130px;"></textarea>
                        <label for="floatingC">Комментарий</label>
                    </div>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="DeliveryType" id="DeliveryType1" value="1">
                  <label class="form-check-label" for="DeliveryType1">Доставка</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="DeliveryType" id="DeliveryType2" value="2" checked>
                  <label class="form-check-label" for="DeliveryType2">Самовывоз</label>
                </div>
                <div class="row mt-3 ">
                  <div class="col-12">
                    <div class="d-none" id="DeliveryTypeCollapse1">
                        <div class="form-floating mb-1">
                            <input type="text" name="address" class="form-control" id="floatingA" placeholder="Адрес доставки" required>
                            <label for="floatingA">Адрес доставки</label>
                            <div class="invalid-feedback">Введите Адрес</div>
                        </div>
                        <div class="alert alert-primary d-flex align-items-center mt-2" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Info:" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                            </svg>
                            <div>
                                С вами свяжуться для уточнения времени доставки
                            </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div id="DeliveryTypeCollapse2">
                        <h4>ст. метро «Киевская»</h4>
                        <p>Часы работы: Пн-Чт, Вс 10:00-22:00, Пт-Сб 10:00-23:00</p>
                        <p>Адрес: Москва, площадь Киевского вокзала, 2, ст. метро «Киевская», 4 этаж, Атриум «Рим», магазин Trendy Hall</p>
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:" fill="currentColor" viewBox="0 0 16 16">
                                <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                            </svg>
                            <div>
                                При самовывозе товар откладываеться не более чем на одни сутки
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="alert alert-warning d-flex align-items-center" role="alert">
                    <svg xmlns="http://www.w3.org/2000/svg" class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </svg>
                    <div>
                        Оплата картой через терминал или переводом на карту. <a href="" class="alert-link text-decoration-underline" >об оплате</a>
                    </div>
                </div>
              <button type="submit" class="btn btn-outline-dark justify-content-center w-50 p-3 fs-4">Оформить</button>

              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
              <link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/css/suggestions.min.css" rel="stylesheet" />
              <script src="https://cdn.jsdelivr.net/npm/suggestions-jquery@21.6.0/dist/js/jquery.suggestions.min.js"></script>
              <script>$("#floatingA").suggestions({token: "30eb4b7fb5e5da4f0791e4768e1a7c23e1a4130e",type: "ADDRESS"});</script>
            </form>
          </div>
        </div>
      </div>
    </div>