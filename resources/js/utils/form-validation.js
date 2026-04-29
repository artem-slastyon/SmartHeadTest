/**
 * Utility functions used in form validation
 */

/**
 *
 * @param {HTMLInputElement} input
 * @returns {Element}
 */
export function getErrorElement(input) {
    let el = input.nextElementSibling
    if (el === null || el.tagName.toLowerCase() !== 'small') {
        el = document.createElement('small');
        el.classList.add('required', 'mb-10');
        input.after(el);
    }

    return el;
}

/**
 *
 * @param {string} id
 * @returns {string}
 */
export function getFieldNameById(id) {
    const string = id.replaceAll('-', ' ');
    return string.charAt(0).toUpperCase() + string.substring(1);
}

/**
 *
 * @param {HTMLInputElement} el
 * @return {string}
 */
export function getErrorMessage(el) {
    if (el.validity.valueMissing) {
        return 'is required!';
    }

    return 'has invalid format!';
}
