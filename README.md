# Application Setup and Testing

This document provides instructions on how to set up and test the application.

## Table of Contents

- [Installation](#installation)
- [Running the Application](#running-the-application)
- [API Endpoint](#api-endpoints)
- [Anonymous API Token](#anonymous-api-token)
- [Running Tests](#running-tests)


## Installation

Follow these steps to install the application:

1. Clone the repository:

   ```bash
   git clone https://github.com/bcguru/kanye-api.git
2. Navigate to the project directory:

    ```bash
    cd kanye-api
3. Install the required dependencies using Composer:

    ```bash
    composer install
## Running the Application

- To run the application, execute the following command:

    ```bash
    php artisan serve
This will start a development server, and you can access the application in your browser at http://localhost:8000.

## API Endpoints
The application provides the following API endpoints:

- GET `/api/quotes`: Fetches 5 random Kayne West quotes.
- GET `/api/quotes/refresh`: Refreshes the quotes and fetches the next 5 random quotes.

To access the API endpoints, you can use tools like CURL or HTTP clients like Postman. Please make sure to include the anonymous API token in the request headers.

## Anonymous API Token
When accessing the `/api/quotes` and `/api/quotes/refresh` endpoints, you need to include the following anonymous API token in the request headers:

    Authorization: my_anonymous_api_token

Make sure to include this token in the Authorization header of your HTTP requests to authenticate and access the API endpoints.

### Example Usage
- Here is an example of how you can use CURL to access the API endpoints:

    ```bash

    # Fetch 5 random Kayne West quotes
    curl -H "Authorization: my_anonymous_api_token" http://127.0.0.1:8000/api/quotes

    # Refresh and fetch the next 5 random quotes
    curl -H "Authorization: my_anonymous_api_token" http://127.0.0.1:8000/api/quotes/refresh

Feel free to explore and utilize these API endpoints to enhance your programming knowledge!

## Running Tests
- The application comes with a suite of unit and feature tests. To run the tests, use the following commands:

    ```bash
    php artisan test
    php artisan test --testsuite=Feature
    php artisan test --testsuite=Unit
This will execute all the tests and display the results in the console.
