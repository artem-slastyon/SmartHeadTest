import { getErrorElement, getErrorMessage, getFieldNameById } from './utils/form-validation.js';
import { convertFileSizeToBytes } from './utils/datasize.js';

function validateForm () {
    let formValid = true;

    const validator = function (inputElement) {
        const errorElement = getErrorElement(inputElement);

        if (inputElement.checkValidity()) {
            errorElement.hidden = true;
        } else {
            const fieldName = getFieldNameById(inputElement.id);
            const errorMessage = getErrorMessage(inputElement);

            errorElement.textContent = `${fieldName} ${errorMessage}`;
            errorElement.hidden = false;

            formValid = false;
        }
    }

    document.querySelectorAll('input, textarea').forEach(validator);

    return formValid;
}

/**
 *
 * @param el
 */
function validateFiles(el) {
    const {maxCount, maxSize} = el.dataset;
    const files = el.files;
    const errorElement = getErrorElement(el);

    if (files.length > maxCount) {
        errorElement.hidden = false;
        errorElement.textContent = 'Maximum count of uploaded files: ' + maxCount;
        return false;
    }

    for (const file of files) {
        if (file.size > convertFileSizeToBytes(maxSize)) {
            errorElement.hidden = false;
            errorElement.textContent = 'Maximum allowed size of file: ' + maxSize;
            return false;
        }
    }

    errorElement.hidden = true;

    return true;
}

function sendTicket (e) {
    e.preventDefault();

    const form = document.querySelector('form');
    const fileField = document.querySelector('input[type="file"]');

    if (!validateForm() || !validateFiles(fileField)) {
        return;
    }

    const formData = new FormData(form);

    fetch(
        API_URL,
        {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
            },
            body: formData
        }
    ).then(response => {

    });
}

document.querySelector('#submit').addEventListener('click', sendTicket);
document.querySelector('input[type="file"]')
    .addEventListener(
        'change',
        (ev) => validateFiles(ev.currentTarget)
    );
