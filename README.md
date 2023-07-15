# Symfony Project with Fixtures and Yarn

This is an existing Symfony project that includes fixtures for populating the database with sample data. It also utilizes Yarn for managing front-end assets.

## Project Setup

To set up and run the project, follow the commands below:

```bash
git clone https://github.com/bindu23593/symfony4-sbadmin.git

composer install

yarn install

php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force

php bin/console doctrine:fixtures:load

yarn run build

php bin/console server:run
```

Default user credentials: admin@admin.test / admin
