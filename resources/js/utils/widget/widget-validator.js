import { getErrorElement, getErrorMessage, getFieldNameById } from '../form-validation.js'
import { convertFileSizeToBytes } from '../datasize.js'

export default class WidgetValidator
{
    /** @var {NodeListOf<HTMLInputElement|HTMLTextAreaElement>} */
    #inputs;

    /** @var {HTMLInputElement} */
    #fileInput;

    /** @var {boolean} */
    #filesValid;

    /** @var {boolean} */
    #formValid;
    constructor () {
        this.#inputs = document.querySelectorAll('input, textarea');
        this.#fileInput = document.querySelector('input[type="file"]');

        document.querySelector('input[type="file"]')
            .addEventListener(
                'change',
                () => this.validateFiles()
            );
    }

    validateForm() {
        this.#formValid = true;

        this.#inputs.forEach(inputElement => {
            if (!inputElement.checkValidity()) {
                this.#formValid = false;
                this.#showError(inputElement);
            }
        })

        if (this.#formValid) {
            this.#hideErrors();
        }
    }

    validateFiles() {
        const {maxCount, maxSize} = this.#fileInput.dataset;
        const files = this.#fileInput.files;

        if (files.length > maxCount) {
            this.#showError(this.#fileInput, 'Maximum count of uploaded files: ' + maxCount);
            this.#filesValid = false;
            return;
        }

        for (const file of files) {
            if (file.size > convertFileSizeToBytes(maxSize)) {
                this.#showError(this.#fileInput, 'Maximum allowed size of file: ' + maxSize);
                this.#filesValid = false;
                return;
            }
        }

        getErrorElement(this.#fileInput).hidden = true
        this.#filesValid = true;
    }

    validate() {
        this.validateForm();
        this.validateFiles();

        return this.#formValid && this.#filesValid;
    }

    /**
     *
     * @param {HTMLInputElement} inputElement
     * @param {?string} fullErrorMessage
     */
    #showError(inputElement, fullErrorMessage = null) {
        const errorElement = getErrorElement(inputElement);

        if (fullErrorMessage !== null) {
            errorElement.textContent = fullErrorMessage;
            errorElement.hidden = false;
            return
        }

        const fieldName = getFieldNameById(inputElement.id);
        const errorMessage = getErrorMessage(inputElement);

        errorElement.textContent = `${fieldName} ${errorMessage}`;
        errorElement.hidden = false;
    }

    #hideErrors() {
        document.querySelectorAll('small').forEach(error => {
            error.hidden;
        })
    }
}
