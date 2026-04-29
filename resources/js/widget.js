function validateForm () {
    /**
     *
     * @param {HTMLInputElement} input
     * @returns {Element}
     */
    const getErrorElement = function (input) {
        let el = input.nextElementSibling
        if (el === null || el.tagName.toLowerCase() !== 'small') {
            el = document.createElement('small')
            el.classList.add('required')
            input.after(el)
        }

        return el
    }

    /**
     *
     * @param {string} id
     * @returns {string}
     */
    const getFieldNameById = function (id) {
        const string = id.replaceAll('-', ' ')
        return string.charAt(0).toUpperCase() + string.substring(1)
    }

    /**
     *
     * @param {HTMLInputElement} el
     * @return {string}
     */
    const getErrorMessage = function (el) {
        if (el.validity.tooLong) {
            return 'too long!'
        }

        if (el.validity.tooShort) {
            return 'too short!'
        }

        if (el.validity.valueMissing) {
            return 'is required!'
        }

        return 'has invalid format!'
    }

    let formValid = true

    const validator = function (inputElement) {
        const errorElement = getErrorElement(inputElement)

        if (inputElement.checkValidity()) {
            errorElement.hidden = true
        } else {
            const fieldName = getFieldNameById(inputElement.id)
            const errorMessage = getErrorMessage(inputElement)

            errorElement.textContent = `${fieldName} ${errorMessage}`
            errorElement.hidden = false

            formValid = false
        }
    }

    document.querySelectorAll('input, textarea').forEach(validator);

    return formValid
}

function sendTicket (e) {
    e.preventDefault()

    if (!validateForm()) {
        return;
    }

    console.log(e.currentTarget);
}

document.querySelector('#submit').addEventListener('click', sendTicket)
