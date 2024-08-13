let quickLinkCounter = 0;

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('adForm');
    const inputs = form.querySelectorAll('input');

    restoreFormData();
    updateDomainUrl();
    updateAdPreview();

    inputs.forEach(input => {
        input.addEventListener('input', (event) => {
            updateAdPreview();
            updateCharCount(event.target);
            updatePunctuationCount(event.target);
            if (input.id === 'url') {
                updateDomainUrl();
            }
        });
        updateCharCount(input);
        updatePunctuationCount(input);
    });

    document.getElementById('addQuickLink').addEventListener('click', () => addQuickLink());
});

function updateAdPreview() {
    const title1 = document.getElementById('title1');
    const title2 = document.getElementById('title2');
    const text = document.getElementById('text');
    const clarifications = document.getElementById('clarifications');
    const url = document.getElementById('url');
    const displayUrl = document.getElementById('displayUrl');
    const phone = document.getElementById('phone');
    const workHours = document.getElementById('workHours');
    const yaContactElements = document.querySelectorAll('[data-id="yaContact"]');
    const yaWorkTimeElements = document.querySelectorAll('[data-id="yaWorkTime"]');
    const yaPhoneElements = document.querySelectorAll('[data-id="yaPhone"]');
    const combinedTitle = `${title1.value} ${title2.value}`.trim();
    const yaTitleElements = document.querySelectorAll('[data-id="yaTitle"]');
    const yaTextWithClarificationsElements = document.querySelectorAll('[data-id="yaTextWithClarifications"]');
    const yaUrlElements = document.querySelectorAll('[data-id="yaUrl"]');

    validateInput(title1, { maxLength: 56, maxWordLength: 22, maxPunctuation: 15 });
    validateInput(title2, { maxLength: 30, maxWordLength: 22, maxPunctuation: 15 });
    validateInput(text, { maxLength: 81, maxWordLength: 23, maxPunctuation: 15 });
    validateInput(clarifications, { maxLength: 132, maxPunctuation: 25, countPunctuationWithSpaces: true });
    validateInput(url, { maxLength: 1024 });
    validateInput(displayUrl, { maxLength: 20 });

    if (yaTitleElements) {
        yaTitleElements.forEach(element => {
            element.textContent = combinedTitle;
        });
    }
    if (yaTextWithClarificationsElements) {
        let combinedText = text.value;
        if (clarifications.value) {
            combinedText += `&nbsp;· ${clarifications.value}`;
        }
        yaTextWithClarificationsElements.forEach(element => {
            element.innerHTML = combinedText;
        });
    }

    const domainUrl = document.getElementById('domainUrl');

    if (yaUrlElements) {
        yaUrlElements.forEach(element => {
            element.innerHTML = `<b>${domainUrl.value}</b><span>&#8250;</span>${displayUrl.value}&hellip;`;
        });
    }

    if (yaContactElements) {
        let contactInfo = [];
        contactInfo.push(`<span><a href="#">Контактная информация</a></span>`);
        if (phone.value) contactInfo.push(`<span><a href="#">${phone.value} Показать</a></span>`);
        if (workHours.value) contactInfo.push(`<span>${workHours.value}</span>`);

        yaContactElements.forEach(element => {
            element.innerHTML = contactInfo.join('');
        });
    }

    if (yaWorkTimeElements && workHours.value) {
        yaWorkTimeElements.forEach(element => {
            element.innerHTML = `<div class="ya-companies-meta-item ya-worktime">${workHours.value}</div>`;
        });
    }

    if (yaPhoneElements && phone.value) {
        yaPhoneElements.forEach(element => {
            element.innerHTML = `<div class="ya-companies-meta-item ya-phone"><a href="#">${phone.value}</a></div>`;
        });
    }

    // Обновляем быстрые ссылки
    const yaQuickLinksElements = document.querySelectorAll('[data-id="yaQuickLinks"]');
    const yaAdditionalQuickLinksElements = document.querySelectorAll('[data-id="yaAdditionalQuickLinks"]');
    const quickLinks = document.querySelectorAll('.quick-link-item');

    // Функция для валидации и получения данных ссылки
    function getLinkData(link) {
        const titleInput = link.querySelector('input[name="quickLinkTitle[]"]');
        const descriptionInput = link.querySelector('input[name="quickLinkDescription[]"]');
        const urlInput = link.querySelector('input[name="quickLinkUrl[]"]');

        validateInput(titleInput, { maxLength: 30 });
        validateInput(descriptionInput, { maxLength: 60 });
        validateInput(urlInput, { maxLength: 1024 });

        return {
            title: titleInput.value,
            url: urlInput.value,
            description: descriptionInput.value
        };
    }

    // Обработка yaQuickLinksElements
    if (yaQuickLinksElements.length) {
        let quickLinksInfo = [];

        quickLinks.forEach((link, index) => {
            if (index < 4) {
                const { title, url } = getLinkData(link);
                if (title && url) {
                    quickLinksInfo.push(`<span><a href="#">${title}</a></span>`);
                }
            }
        });

        yaQuickLinksElements.forEach(element => {
            element.innerHTML = quickLinksInfo.join('');
        });
    }

    // Обработка yaAdditionalQuickLinksElements
    if (yaAdditionalQuickLinksElements.length) {
        let additionalQuickLinksInfo = [];

        quickLinks.forEach((link, index) => {
            if (index >= 4) {
                const { title, url, description } = getLinkData(link);
                if (title && url) {
                    additionalQuickLinksInfo.push(`
                        <div class="Sitelinks-Item sitelinks__item">
                            <a href="#">${title}</a>
                            <div class="description">${description}</div>
                        </div>
                    `);
                }
            }
        });

        if (additionalQuickLinksInfo.length > 0) {
            const additionalContent = `
                <div class="d-flex flex-wrap">
                    ${additionalQuickLinksInfo.join('')}
                </div>
            `;
            yaAdditionalQuickLinksElements.forEach(element => {
                element.innerHTML = additionalContent;
            });
        } else {
            yaAdditionalQuickLinksElements.forEach(element => {
                element.innerHTML = '';
            });
        }
    }

    saveFormData();
}

function validateInput(inputElement, constraints) {
    const { maxLength, maxWordLength, maxPunctuation, countPunctuationWithSpaces } = constraints;
    const value = inputElement.value;
    const words = value.split(/\s+/);
    const punctuationRegex = countPunctuationWithSpaces ? /[.,!?;:\s]/g : /[.,!?;:]/g;
    const punctuationCount = (value.match(punctuationRegex) || []).length;
    const errorElement = document.getElementById(`${inputElement.id}-error`);

    let error = '';

    if (value.length > maxLength) {
        error = `Превышена максимальная длина (${maxLength} символов)`;
    } else if (maxWordLength && words.some(word => word.length > maxWordLength)) {
        error = `Одно из слов превышает ${maxWordLength} символов`;
    } else if (maxPunctuation && punctuationCount > maxPunctuation) {
        error = `Превышено количество знаков препинания (макс. ${maxPunctuation})`;
    }

    if (errorElement) {
        errorElement.textContent = error;
        toggleErrorVisibility(errorElement);
    }
    inputElement.setCustomValidity(error);
}

function updateCharCount(input) {
    const maxLength = input.maxLength;
    let currentLength = input.value.length;
    let remainingChars = maxLength - currentLength;

    const countElement = document.getElementById(`${input.id}-count`);
    if (countElement) {
        countElement.textContent = remainingChars;
    }
}

function updatePunctuationCount(input) {
    const punctuationRegex = input.id === 'clarifications' ? /[.,!?;:\s]/g : /[.,!?;:]/g;
    const punctuationCount = (input.value.match(punctuationRegex) || []).length;
    const countElement = document.getElementById(`${input.id}-punctuation-count`);
    if (countElement) {
        const maxPunctuation = input.id === 'clarifications' ? 25 : 15;
        const remainingPunctuation = maxPunctuation - punctuationCount;
        countElement.textContent = remainingPunctuation;
    }
}

function updateDomainUrl() {
    const urlInput = document.getElementById('url');
    const domainUrlInput = document.getElementById('domainUrl');

    try {
        const url = new URL(urlInput.value);
        domainUrlInput.value = url.hostname;
    } catch (e) {
        domainUrlInput.value = '';
    }
}

function toggleErrorVisibility(errorElement) {
    if (errorElement.textContent.trim() === '') {
        errorElement.style.display = 'none';
        errorElement.parentElement.classList.remove('was-validated');
    } else {
        errorElement.style.display = 'block';
        errorElement.parentElement.classList.add('was-validated');
    }
}

function saveFormData() {
    const formData = {
        title1: document.getElementById('title1').value,
        title2: document.getElementById('title2').value,
        text: document.getElementById('text').value,
        clarifications: document.getElementById('clarifications').value,
        url: document.getElementById('url').value,
        displayUrl: document.getElementById('displayUrl').value,
        phone: document.getElementById('phone').value,
        workHours: document.getElementById('workHours').value,
        quickLinks: Array.from(document.querySelectorAll('.quick-link-item')).map(item => ({
            title: item.querySelector('input[name="quickLinkTitle[]"]').value,
            description: item.querySelector('input[name="quickLinkDescription[]"]').value,
            url: item.querySelector('input[name="quickLinkUrl[]"]').value
        }))
    };
    localStorage.setItem('adFormData', JSON.stringify(formData));
}

function restoreFormData() {
    const savedData = JSON.parse(localStorage.getItem('adFormData'));
    if (savedData) {
        document.getElementById('title1').value = savedData.title1 || '';
        document.getElementById('title2').value = savedData.title2 || '';
        document.getElementById('text').value = savedData.text || '';
        document.getElementById('clarifications').value = savedData.clarifications || '';
        document.getElementById('url').value = savedData.url || '';
        document.getElementById('displayUrl').value = savedData.displayUrl || '';
        document.getElementById('phone').value = savedData.phone || '';
        document.getElementById('workHours').value = savedData.workHours || '';

        // Очищаем существующие быстрые ссылки
        const quickLinksFields = document.getElementById('quickLinksFields');
        quickLinksFields.innerHTML = '';

        if (savedData.quickLinks) {
            savedData.quickLinks.forEach(link => {
                addQuickLink(link);
            });
        }
    }
}

function addQuickLink(linkData = null) {
    const quickLinksFields = document.getElementById('quickLinksFields');
    const newQuickLink = document.createElement('div');
    newQuickLink.className = 'quick-link-item mb-2';
    const uniqueId = `ql_${quickLinkCounter++}`;

    newQuickLink.innerHTML = `
        <div class="row g-2">
            <div class="col-md-4">
                <label for="quickLinkTitle-${uniqueId}" class="form-label text-info">Заголовок <span class="text-info small text-opacity-50">(еще <span id="quickLinkTitle-${uniqueId}-count">30</span> символов)</span></label>
                <input type="text" class="form-control" id="quickLinkTitle-${uniqueId}" name="quickLinkTitle[]" placeholder="Заголовок" maxlength="30">
                <div class="invalid-feedback" id="quickLinkTitle-${uniqueId}-error"></div>
            </div>
            <div class="col-md-4">
                <label for="quickLinkDescription-${uniqueId}" class="form-label text-info">Описание <span class="text-info small text-opacity-50">(еще <span id="quickLinkDescription-${uniqueId}-count">60</span> символов)</span></label>
                <input type="text" class="form-control" id="quickLinkDescription-${uniqueId}" name="quickLinkDescription[]" placeholder="Описание" maxlength="60">
                <div class="invalid-feedback" id="quickLinkDescription-${uniqueId}-error"></div>
            </div>
            <div class="col-md-3">
                <label for="quickLinkUrl-${uniqueId}" class="form-label text-info">Ссылка</label>
                <input type="url" class="form-control" id="quickLinkUrl-${uniqueId}" name="quickLinkUrl[]" placeholder="Ссылка" maxlength="1024">
                <div class="invalid-feedback" id="quickLinkUrl-${uniqueId}-error"></div>
            </div>
            <div class="col-md-1 d-flex align-items-end">
                <button type="button" class="btn btn-outline-danger remove-quick-link">&times;</button>
            </div>
        </div>
    `;

    quickLinksFields.appendChild(newQuickLink);

    newQuickLink.querySelector('.remove-quick-link').addEventListener('click', function () {
        quickLinksFields.removeChild(newQuickLink);
        updateQuickLinkCount();
        updateAdPreview();
    });

    const inputs = newQuickLink.querySelectorAll('input');
    if (linkData) {
        inputs[0].value = linkData.title || '';
        inputs[1].value = linkData.description || '';
        inputs[2].value = linkData.url || '';
    }

    inputs.forEach(input => {
        input.addEventListener('input', function (event) {
            updateCharCount(event.target);
            updateAdPreview();
        });
        updateCharCount(input);
    });

    updateQuickLinkCount();
    updateAdPreview();
}

function updateQuickLinkCount() {
    const quickLinkCount = document.querySelectorAll('.quick-link-item').length;
    const addQuickLinkButton = document.getElementById('addQuickLink');
    addQuickLinkButton.style.display = quickLinkCount >= 8 ? 'none' : 'block';
}
