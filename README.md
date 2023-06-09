Test-Driven Development (TDD) for WordPress Plugins

This repo provides a setup for implementing Test-Driven Development (TDD) for WordPress plugins, using Docker and PHPUnit.

The repo was inspired by this tutorial, but has been updated to work with PHP 8 and has several enhancements.
Setup

This project requires Docker. Check if Docker is installed:

bash

docker --version

The output should be something like:

bash

Docker version 20.10.22, build 3a2c30b

Installing and Running Docker

First, build the Docker image:

bash

DOCKER_BUILDKIT=1 docker-compose build wp

Then, run the Docker container:

bash

docker-compose up

Installing Test Suite

Run the following commands to scaffold the tests for your plugin (replace your-plugin-name with the name of your plugin):

bash

docker-compose exec wp wp-cli scaffold plugin-tests your-plugin-name
docker-compose exec wp install-wp-tests

Installing PHP Dependencies

You need to install or update PHP dependencies inside the Docker container. Do this by running:

bash

docker-compose exec wp composer update

Now you're ready to write tests and code!
Running Tests

There is a prepared test that you can run to make sure everything is working correctly:

bash

docker-compose exec wp composer phpunit

The output should be something like:

bash

PHPUnit 9.6.7 by Sebastian Bergmann and contributors.

.                                                                  
1 / 1 (100%)

Time: 00:00.024, Memory: 36.50 MB

OK (1 test, 1 assertion)

Using Composer

You can use Composer to manage dependencies. Make sure you run Composer commands within the Docker container, like so:

bash

docker exec -it tdd-plugin-app composer --working-dir=my-plugin-directory install

PHPStan and PHPCS

This setup also includes PHPStan for static analysis and PHPCS for code style checking. The necessary packages are included in the composer.json file and the configuration is set up to work with WordPress. You can run PHPStan and PHPCS commands using Composer.
Note

Remember to enable Docker BuildKit for the Docker image to build correctly. You can enable it by running export DOCKER_BUILDKIT=1 in your shell, or by setting "features": {"buildkit": true} in Docker's daemon.json file.

# TODO File and Folder Permissions
Something like: 
# mkdir bin
chmod 777 bin tests
# touch .travis.yml .phpcs.xml.dist phpunit.xml.dist
chmod 777 .travis.yml .phpcs.xml.dist phpunit.xml.dist
chmod 777 .phpunit.result.cache