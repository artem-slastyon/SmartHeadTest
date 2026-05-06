### Deploy in docker devenv manual

Setup script automatically installs all dependencies and migrates database

Docker development environment located [here](https://github.com/artem-slastyon/SmartHeadDocker)

### Screenshots

<img width="1905" height="666" alt="tickets" src="https://github.com/user-attachments/assets/d58d4044-7ba8-4b12-b7e7-4e2f95df5845" />

<img width="1905" height="734" alt="ticket" src="https://github.com/user-attachments/assets/904bdde4-5d97-468c-96d8-60faa11d83af" />

<img width="296" height="606" alt="widget" src="https://github.com/user-attachments/assets/47e3cb1a-62ca-4e32-80d2-13ec79dfba1f" />

### Test data

Seeders adds to database customers, tickets and users to test

Test admin user has these credentials:

Email: `test@example.com`

Password: `password`

### Widget integration
You can integrate widget by copying this HTML code
```html
<iframe src="https://smarthead.tenorium.local/widget" width="300" height="700"></iframe>
```

### API

This app has API endpoint to create ticket (used by widget), and to get statistic.

Inside file openapi.yaml you can find API specification in format OpenAPI v3.

Also, in docker devenv added Swagger UI instance accessable at http://smarthead.tenorium.local:8080
