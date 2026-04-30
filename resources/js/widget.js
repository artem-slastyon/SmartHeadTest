import WidgetValidator from './utils/widget/widget-validator.js'
import WidgetAlert from './utils/widget/widget-alert.js'

const validator = new WidgetValidator();

function sendTicket (e) {
    e.preventDefault();

    if (!validator.validate()) {
        return;
    }

    const form = document.querySelector('form');
    const formData = new FormData(form);

    const alert = new WidgetAlert();

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
        response.json().then(json => {
            if (json.status === 'ok') {
                alert.success('Ticket was sent successfully');
                return;
            }

            if (json.status === 'ratelimited') {
                alert.error('You can send only one ticket per day');
            }

            alert.error(json.message ?? 'Error at ticket sending');
        });
    });
}

document.querySelector('#submit').addEventListener('click', sendTicket);
