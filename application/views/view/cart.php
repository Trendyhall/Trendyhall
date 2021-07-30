
<div class="row">
    <div class="col col-12 col-sm-8" id="cartCardsContainer">
        <div class="w-100 d-flex justify-content-center align-content-center">
            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="col col-12 col-sm-4">
        <div class="overflow-auto mb-3" style="height: 60vh;" id="cartOverview">
            <div class="w-100 d-flex justify-content-center align-content-center">
                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        <h4 class="mb-3"></h4>
        <button class="btn btn-outline-dark rounded-0 w-100" id="BuyBtn" data-bs-toggle="modal" data-bs-target="#BuyModal">Заказать</button>
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
            <form name="order" class="needs-validation" method="post" action="" accept-charset="utf-8" novalidate>
                <input name="orderBody" type="text" hidden>
                <div class="mb-3">
                    <div class="form-floating mb-2">
                        <input type="text" name="name" class="form-control" id="floatingN" placeholder="Имя Фамилия Отчество" required>
                        <label for="floatingN">Имя Фамилия Отчество</label>
                        <div class="invalid-feedback">Введите Имя Фамилия Отчество</div>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="text" name="phone" class="form-control" id="floatingP" placeholder="Номер телефона" required>
                        <label for="floatingP">Номер телефона</label>
                        <div class="invalid-feedback">Введите номер телефона</div>
                    </div>
                    <div class="form-floating mb-2">
                        <textarea name="patronymic" class="form-control" id="floatingM" placeholder="Комментарий" style="height: 130px;" required></textarea>
                        <label for="floatingM">Комментарий</label>
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
                            <input type="text" name="addres" class="form-control" id="floatingA" placeholder="Адрес доставки" required>
                            <label for="floatingA">Адрес доставки</label>
                            <div class="invalid-feedback">Введите Адрес</div>
                        </div>
                        <p>С вами свяжуться для уточнения времени доставки</p>
                    </div>
                  </div>
                  <div class="col-12">
                    <div id="DeliveryTypeCollapse2">
                        <h4>ТРЦ «Европейский»</h4>
                        <p>Часы работы: Пн-Чт, Вс 10:00-22:00, Пт-Сб 10:00-23:00</p>
                        <p>Адрес: Москва, площадь Киевского вокзала, 2, ст. метро «Киевская», 4 этаж, Атриум «Рим», магазин Trendy Hall</p>
                    </div>
                  </div>
                </div>
                <div class="alert alert-warning" role="alert">
                    Оплата картой или переводом на карту. <a href="" class="alert-link">об оплате</a>
                </div>
              <button type="submit" class="btn btn-outline-dark justify-content-center w-50 p-3">Оформить</button>
            </form>
          </div>
        </div>
      </div>
    </div>