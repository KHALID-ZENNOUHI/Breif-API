# Breif-API

This project is an API to provide a car valuation service. The API offers various functionalities including user management, car querying, and car price estimation.

## Project Context

Iwant to provide a car valuation service. To achieve this, it has a database containing detailed information about cars, including brand, model, mileage, registration date, power, fuel type, engine type, and options.

## API Functionalities

1. **User Management:**

    - Creation of a default administrator via a seeder.
    - User management by the administrator: creation, modification, deletion.
    - User authentication and access token retrieval.

2. **Car Querying:**

    - Users can query information about cars available in the database.

3. **Car Price Estimation:**
    - Users have the ability to estimate the price of a car based on the information available in the database.

## Unit Tests

Unit tests have been written for each functionality using PHPUnite to ensure the reliability and robustness of the API.

## GitHub Workflow

A GitHub workflow has been set up to automate the build, test, and deployment process. This ensures continuous integration and smooth deployment of API updates.

## Installation

To install and run the API locally, please follow these steps:

-   Clone this repository to your local machine.
-   Install dependencies by running `composer install`.
-   Configure environment variables as needed (e.g., database information).
-   Run unit tests with the command `vendor/bin/phpunit`.
-   Start the local server by running `php -S localhost:8000 -t public`.
-   You can now access the API via `http://localhost:8000`.

## Contribution

Contributions to this project are welcome. For any suggestions or issues, please open an issue or submit a pull request.

---

This is a general description of the Car Estimation API. For detailed usage of each endpoint, please refer to the API documentation.
