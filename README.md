# Tenorium Feedback

Mini-CRM for collecting and handling tickets from the site through a widget

---

## 🛠 Tech Stack

* **PHP**: 8.4
* **Framework**: Laravel 12
* **Database**: MariaDB 12
* **Environment**: Docker & Docker Compose

---

## 🚀 Quick start

### Requirements
* Git
* Docker Engine and Docker Compose

### Deploy instruction

1. **Clone repository:**
   ```bash
   git clone https://github.com/artem-slastyon/TenoriumFeedback.git
   cd TenoriumFeedback
   ```

2. **Prepare environment configuration file:**
   ```bash
   cp .env.example .env
   ```

3. **Startup containers:**
   ```bash
   docker compose up -d
   ```

4. **Initialize project:**
   ```bash
   docker compose exec app php artisan key:generate
   docker compose exec app php artisan migrate --seed
   ```

After completing these steps, the app will be available at: http://127.0.0.1:8080

### Test data

To seed test data - like customers, tickets, and a test user, you can run the following command:
```bash
docker compose exec app php artisan db:seed TestDataSeeder
```

Test admin user has these credentials:

> Email: `test@example.com`
> Password: `password`

### Widget integration
You can integrate the widget by copying this HTML code as an example
```html
<iframe src="http://127.0.0.1:8080/widget" width="300" height="700"></iframe>
```

### API

File docs/openapi.yaml contains the API specification in OpenAPI v3.

Swagger UI instance available at http://127.0.0.1:8081

## Screenshots

<img width="1905"  alt="tickets" src="./docs/images/ticket-list.png" />

<img width="1905" alt="ticket" src="./docs/images/ticket-view.png" />

<img width="296" alt="widget" src="docs/images/widget.png" />

## 🛠 Development

For active development, this project supports integration with a dev environment wrapper (DEW)

The setup script will fully prepare the local system
* 🔑 **SSL/TLS-certificates:** Automatic certificate generation via `mkcert`.
* 🌐 **DNS & Routing:** Automatic domain setup in `/etc/hosts`.
* 🐳 **Environment:** Deployment of shared services (Apache, MariaDB, Swagger UI, PHP 8.4).

### Requirements:

- docker-compose
- mkcert (after installation, run `mkcert -install` to install local CA)
- bash or zsh (optional, for autocomplete to work)

### Quickstart:

1. Clone and start the setup script:
   ```bash
   git clone [https://github.com/artem-slastyon/TenoriumFeedbackDocker.git](https://github.com/artem-slastyon/TenoriumFeedbackDocker.git) ~/workspace/feedback
   cd ~/workspace/feedback
   ./scripts/main.sh setup
   ```
2. After setup, restart your shell and type:
   ```bash
   feedback up
   ```


After startup, the app will be available at https://feedback.tenorium.local
Swagger UI will be available at https://feedback.tenorium.local:8080

To get full DEW command documentation, follow the [DEW repository link](https://github.com/artem-slastyon/TenoriumFeedbackDocker).
