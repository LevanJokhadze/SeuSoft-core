
# SeuSoft

A brief description of what this project does and who it's for.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

What things you need to install the software and how to install them:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
```

### Installing

A step-by-step series of examples that tell you how to get a development environment running:

```bash
npm install
npm run dev
php artisan serve
```

## API Endpoints

Description of the main API endpoints.

### Contacts

- **POST /api/contacts** - Create a new contact
  - **Parameters**
    - `name` - [required] The contact's first name.
    - `last_name` - [required] The contact's last name.
    - `email` - [required] The contact's email address.
    - `number` - [optional] The contact's phone number.
    - `service` - [required] The service interest.
    - `company` - [optional] The company name.
    - `message` - [optional] Additional message.
  - **Success Response:**
    - **Code:** 201 CREATED
    - **Content:** `{ "message": "Contact created successfully", "data": { contact details } }`
  - **Error Response:**
    - **Code:** 500 INTERNAL SERVER ERROR
    - **Content:** `{ "message": "Failed to create contact" }`

## Running the Tests

Explain how to run the automated tests for this system.

```bash
php artisan test
```

## Deployment

Add additional notes about how to deploy this on a live system.

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [MySQL](https://www.mysql.com/) - Database
* [Composer](https://getcomposer.org/) - Dependency Management

## Contributing

Please read [CONTRIBUTING.md](https://example.com/CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We use [SemVer](http://semver.org/) for versioning. For the versions available, see the [tags on this repository](https://example.com/project/tags).

## Authors

* **Your Name** - *Initial work* - [YourProfile](https://github.com/YourProfile)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
