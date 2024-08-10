<section class="container pt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-10">
            <form id="adForm" class="needs-validation" novalidate>
                <ul class="nav nav-tabs" id="adFormTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="ad-tab" data-bs-toggle="tab" data-bs-target="#ad" type="button" role="tab" aria-controls="ad" aria-selected="true">Объявление</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Контактные данные</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="quick-links-tab" data-bs-toggle="tab" data-bs-target="#quick-links" type="button" role="tab" aria-controls="quick-links" aria-selected="false">Быстрые ссылки</button>
                    </li>
                </ul>

                <div class="tab-content p-3 border border-top-0 rounded-bottom" id="adFormTabContent">
                    <div class="tab-pane fade show active" id="ad" role="tabpanel" aria-labelledby="ad-tab">
                        <div class=" row mb-2">
                            <div class="col-md-6">
                                <label for="title1" class="form-label text-info">Заголовок <span class="text-info small text-opacity-50">(еще <span id="title1-count">56</span> символов, <span id="title1-punctuation-count">15</span> знаков)</span></label>
                                <input type="text" class="form-control" id="title1" name="title1" maxlength="56" value="Кухни «Мария» – красота и функциональность.">
                                <div class="invalid-feedback" id="title1-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="title2" class="form-label text-info">Доп. заголовок <span class="text-info small text-opacity-50">(еще <span id="title2-count">30</span> символов, <span id="title2-punctuation-count">15</span> знаков)</span></label>
                                <input type="text" class="form-control" id="title2" name="title2" maxlength="30" value="Создайте кухню своей мечты.">
                                <div class="invalid-feedback" id="title2-error"></div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="text" class="form-label text-info">Текст объявления <span class="text-info small text-opacity-50">(еще <span id="text-count">81</span> символов, <span id="text-punctuation-count">15</span> знаков)</span></label>
                            <input type="text" class="form-control" id="text" name="text" maxlength="81" value="Новая кухня «Мария» от 180 тыс. Микс современных материалов и технологий.">
                            <div class="invalid-feedback" id="text-error"></div>
                        </div>

                        <div class="mb-2">
                            <label for="clarifications" class="form-label text-info">Уточнения <span class="text-info small text-opacity-50">(еще <span id="clarifications-count">132</span> символов, <span id="clarifications-punctuation-count">25</span> знаков)</span></label>
                            <input type="text" class="form-control" id="clarifications" name="clarifications" maxlength="132" value="Бесплатная доставка • Гарантия 5 лет • Рассрочка">
                            <div class="invalid-feedback" id="clarifications-error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="url" class="form-label text-info">URL <span class="text-info small text-opacity-50">(еще <span id="url-count">1024</span> символов)</span></label>
                            <input type="url" class="form-control" id="url" name="url" maxlength="1024" value="https://on-test.ru/?calltouch_tm=yd_c%3A99344248_gb%3A5318973610_ad%3A15262147226_ph%3A48093825503_st%3Asearch_pt%3Apremium_p%3A1_s%3Anone_dt%3Adesktop_reg%3A213_ret%3A48093825503_apt%3Anone&k50id=0100000048093825503_48093825503">
                            <div class="invalid-feedback" id="url-error"></div>
                        </div>

                        <div class="mb-2">
                            <label for="displayUrl" class="form-label text-info">Отображаемая ссылка <span class="text-info small text-opacity-50">(еще <span id="displayUrl-count">20</span> символов)</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="domainUrl" name="domainUrl" readonly disabled>
                                <input type="text" class="form-control" id="displayUrl" name="displayUrl" maxlength="20" value="Кухни-корпус-массив">
                            </div>
                            <div class="invalid-feedback" id="displayUrl-error"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="mb-3">
                            <label for="phone" class="form-label text-info">Телефон</label>
                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="+7 (999) 999-99-99">
                            <div class="invalid-feedback" id="phone-error"></div>
                        </div>
                        <div class="mb-3">
                            <label for="workHours" class="form-label text-info">Режим работы</label>
                            <input type="text" class="form-control" id="workHours" name="workHours" placeholder="Пн-Пт: 9:00-18:00, Сб-Вс: выходной">
                            <div class="invalid-feedback" id="workHours-error"></div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="quick-links" role="tabpanel" aria-labelledby="quick-links-tab">
                        <div class="mb-2" id="quickLinksContainer">
                            <div id="quickLinksFields"></div>
                            <button type="button" class="btn btn-outline-secondary mt-2" id="addQuickLink">Добавить ещё</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>