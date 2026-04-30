export default class WidgetAlert {
    /** @var {Element} */
    #element;
    constructor () {
        this.#element = document.querySelector('.alert');
    }

    success(message) {
        this.#updateAlert('success', message);
    }

    error(message) {
        this.#updateAlert('danger', message);
    }

    #updateAlert(colorClass, text) {
        this.#element.hidden = false;
        this.#element.className = `alert alert-${colorClass}`;
        this.#element.textContent = text
    }
}
