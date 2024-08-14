<section class="container pt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-10">
            <form id="adForm" class="needs-validation" novalidate>
                <input type="hidden" id="formId" name="formId">
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
                                <input type="text" class="form-control" id="title1" name="title1" maxlength="56">
                                <div class="invalid-feedback" id="title1-error"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="title2" class="form-label text-info">Доп. заголовок <span class="text-info small text-opacity-50">(еще <span id="title2-count">30</span> символов, <span id="title2-punctuation-count">15</span> знаков)</span></label>
                                <input type="text" class="form-control" id="title2" name="title2" maxlength="30">
                                <div class="invalid-feedback" id="title2-error"></div>
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="text" class="form-label text-info">Текст объявления <span class="text-info small text-opacity-50">(еще <span id="text-count">81</span> символов, <span id="text-punctuation-count">15</span> знаков)</span></label>
                            <input type="text" class="form-control" id="text" name="text" maxlength="81">
                            <div class="invalid-feedback" id="text-error"></div>
                        </div>

                        <div class="mb-2">
                            <label for="clarifications" class="form-label text-info">Уточнения <span class="text-info small text-opacity-50">(еще <span id="clarifications-count">132</span> символов, <span id="clarifications-punctuation-count">25</span> знаков)</span></label>
                            <input type="text" class="form-control" id="clarifications" name="clarifications" maxlength="132">
                            <div class="invalid-feedback" id="clarifications-error"></div>
                        </div>
                        <div class="mb-2">
                            <label for="url" class="form-label text-info">URL <span class="text-info small text-opacity-50">(еще <span id="url-count">1024</span> символов)</span></label>
                            <input type="url" class="form-control" id="url" name="url" maxlength="1024">
                            <div class="invalid-feedback" id="url-error"></div>
                        </div>

                        <div class="mb-2">
                            <label for="displayUrl" class="form-label text-info">Отображаемая ссылка <span class="text-info small text-opacity-50">(еще <span id="displayUrl-count">20</span> символов)</span></label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="domainUrl" name="domainUrl" readonly disabled>
                                <input type="text" class="form-control" id="displayUrl" name="displayUrl" maxlength="20">
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
            <div class="mt-3">
                <div class="d-flex flex-column flex-lg-row justify-content-between">
                    <button id="copySaveButton" class="btn btn-primary d-flex align-items-center mb-3 mb-lg-0" data-bs-toggle="tooltip" data-bs-placement="top" title="">
                        <svg width="24" height="24" class="me-2" fill="white" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd">
                            <path d="M14.851 11.923c-.179-.641-.521-1.246-1.025-1.749-1.562-1.562-4.095-1.563-5.657 0l-4.998 4.998c-1.562 1.563-1.563 4.095 0 5.657 1.562 1.563 4.096 1.561 5.656 0l3.842-3.841.333.009c.404 0 .802-.04 1.189-.117l-4.657 4.656c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-1.952-1.951-1.952-5.12 0-7.071l4.998-4.998c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464.493.493.861 1.063 1.105 1.672l-.787.784zm-5.703.147c.178.643.521 1.25 1.026 1.756 1.562 1.563 4.096 1.561 5.656 0l4.999-4.998c1.563-1.562 1.563-4.095 0-5.657-1.562-1.562-4.095-1.563-5.657 0l-3.841 3.841-.333-.009c-.404 0-.802.04-1.189.117l4.656-4.656c.975-.976 2.256-1.464 3.536-1.464 1.279 0 2.56.488 3.535 1.464 1.951 1.951 1.951 5.119 0 7.071l-4.999 4.998c-.975.976-2.255 1.464-3.535 1.464-1.28 0-2.56-.488-3.535-1.464-.494-.495-.863-1.067-1.107-1.678l.788-.785z" />
                        </svg>
                        Сохранить форму и скопировать ссылку в буфер
                    </button>
                    <button id="clearFormButton" class="btn btn-danger d-flex align-items-center mb-3 mb-lg-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="me-2" fill="white" viewBox="0 0 512 512"><path d="M400 113.3h-80v-20c0-16.2-13.1-29.3-29.3-29.3h-69.5C205.1 64 192 77.1 192 93.3v20h-80V128h21.1l23.6 290.7c0 16.2 13.1 29.3 29.3 29.3h141c16.2 0 29.3-13.1 29.3-29.3L379.6 128H400v-14.7zm-193.4-20c0-8.1 6.6-14.7 14.6-14.7h69.5c8.1 0 14.6 6.6 14.6 14.7v20h-98.7v-20zm135 324.6v.8c0 8.1-6.6 14.7-14.6 14.7H186c-8.1 0-14.6-6.6-14.6-14.7v-.8L147.7 128h217.2l-23.3 289.9z"></path><path d="M249 160h14v241h-14zM320 160h-14.6l-10.7 241h14.6zM206.5 160H192l10.7 241h14.6z"></path></svg>
                        Очистить форму</button>
                </div>
            </div>
        </div>
    </div>
</section>