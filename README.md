# Project Vehicle Booking website

## Introduction

This project uses [Laravel](https://laravel.com/) for the backend (version:10x), [Vue.js](https://vuejs.org/) for the frontend and [MongoDb](https://www.mongodb.com/) for save database. It is a web application designed to user can sign in(user, google, facebook) and can book vehicle.

## Libraries and Tools

### Backend Libraries

- **[Laravel](https://laravel.com/)**: The PHP framework for building web applications.
- **[Eloquent ORM](https://laravel.com/docs/eloquent)**: Laravel's ORM for database interaction.
- **[Laravel Sanctum](https://laravel.com/docs/sanctum)**: Simple token authentication for APIs.

### Database (Laravel + MongoDb)

- **[Laravel MongoDb](https://www.mongodb.com/docs/drivers/php/laravel-mongodb/v4.x/)**: Connect database MongoDb with Laravel.

### Frontend Libraries

- **[Vue.js](https://vuejs.org/)**: The progressive JavaScript framework for building user interfaces.
- **[Vue Router](https://router.vuejs.org/)**: The official router for Vue.js.
- **[Vuex](https://vuex.vuejs.org/)**: State management pattern and library for Vue.js applications.
- **[Axios](https://axios-http.com/)**: Promise-based HTTP client for the browser and Vue.js.
- **[Bootstrap Vue](https://bootstrap-vue.org/)**: Bootstrap components for Vue.js.

### Development Tools

- **[UX-UI](https://antdv.com)**: Ant Design Vue .
- **[Animation]**: Aos , animate.css, chart.js, vue-toastification, rellax .
- **[Socialite](https://github.com/vormkracht10/laravel-google-analytics-v4)**: Get data user by google-analytics .

## Setting Up the Development Environment

### Setting Up Laravel

1. **Clone the repository**:

    ```bash
    git clone https://github.com/NguyenVanPhuoc1/booking_vehicle.git
    cd repository
    ```

2. **Install dependencies**:

    ```bash
    composer install 
    ```

3. **Create a `.env` file from the sample**:

    ```bash
    cp .env.example .env
    ```

4. **Generate the application key**:

    ```bash
    php artisan key:generate
    ```

5. **Run migrations (if needed)**:

    ```bash
    php artisan migrate
    ```

6. **Start the development server**:

    ```bash
    php artisan serve
    ```

### Setting Up Vue.js 3

1. **Install Node.js and npm**: Make sure you have [Node.js](https://nodejs.org/) and npm installed.

2. **Install frontend dependencies**:

    ```bash
    npm install
    ```

3. **Start the Vue development server**:

    ```bash
    npm run dev
    ```

## Usage

- **Running the Application**: After setting up, you can access the application at [http://127.0.0.1:8000](http://127.0.0.1:8000) for the backend and [http://localhost:5173](http://localhost:5173) for the frontend.

- **Adding New Features**: Instructions on how to add new features or update the application.

- **Contributing**: Guidelines for contributing to the project.

## Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/v3/guide/)

## Contact

For any questions, please reach out to [nguyenvanphuoc031123@gmail.com](mailto:nguyenvanphuoc031123@gmail.com).

