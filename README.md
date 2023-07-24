# Symfony Project with Fixtures and Yarn

This is an existing Symfony project that includes fixtures for populating the database with sample data. It also utilizes Yarn for managing front-end assets.

## Project Setup

To set up and run the project, follow the commands below:

```bash
git clone https://github.com/bindu23593/symfony4-sbadmin.git

rename file ".env.example" to ".env"

change database connection in .env file

composer install

if yarn is not installed in your system then run command "npm install --global yarn"

yarn install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

yarn run build

php bin/console server:run
