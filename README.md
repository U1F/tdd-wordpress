# tdd-wordpress
Stolen from: 
https://marioyepes.com/wordpress-plugin-tdd-with-docker-phpunit/

- The Dockerfile has to be changed to the name of the plugin
There was an issue when trying to evoke phpunit and this helped:
https://www.smashingmagazine.com/2017/12/automated-testing-wordpress-plugins-phpunit/
- phpunit version bumped so it works with php8
- There were some spelling mistakes

# How to use
```bash
# install the dependencies with composer
#composer install <- don't do that yet. We do it inside the container
# make sure docker is running
docker --version
# It should show someting like this:
# Docker version 20.10.22, build 3a2c30b

# Next, build the docker image
docker-compose build wp

# Now, run the docker container if it's not running already:
docker-compose up

# We now need to install scaffold and wp-tests inside the container
# On another terminal run (change the name of the plugin):
docker-compose exec wp wp-cli scaffold plugin-tests wordpress-tdd-plugin

# Now we install the tests
docker-compose exec wp install-wp-tests

# We have to install the php dependencies (install or update)
docker-compose exec wp composer update

# There is a prepared test that should work now. Check with:
docker-compose exec wp composer phpunit

# It should show something like this:
# 
# PHPUnit 9.6.7 by Sebastian Bergmann and contributors.
# 
# .                                                                  
#  1 / 1 (100%)
# 
# Time: 00:00.024, Memory: 36.50 MB
# 
# OK (1 test, 1 assertion)

# You're ready to go!
```
# command history
(The commands that are no longer needed are commented out.)

Set up the repo:
```bash
# touch .gitignore
# git add .
# git commit -m "first commit"
# git branch -m main
``` 

If the files in this repo are set up correctly install the 'test-suite':
```bash
DOCKER_BUILDKIT=1 docker-compose build wp
docker-compose up
```

On another termonal:
```bash
# mkdir tests
# mkdir bin
chmod 777 bin tests
# touch .travis.yml .phpcs.xml.dist phpunit.xml.dist
chmod 777 .travis.yml .phpcs.xml.dist phpunit.xml.dist
docker-compose exec wp wp-cli scaffold plugin-tests wordpress-tdd-plugin


```

We also would need phpunit of course
```bash
# mkdir vendor
# touch composer.json composer.lock
chmod 777 vendor composer.json composer.lock
docker-compose exec wp install-wp-tests
# docker-compose exec wp composer require phpunit/phpunit=^7
# touch .phpunit.result.cache
chmod 777 .phpunit.result.cache
docker-compose exec wp composer update
docker-compose exec wp composer phpunit
``` 

In case we also want static code analysis with phpstan and wordpress rules
```bash
# touch phpstan.neon
# docker-compose exec wp composer require -dev phpstan/phpstan
sudo chown -R www-data:www-data vendor

docker-compose exec wp composer require --dev phpstan/phpstan
docker-compose exec wp composer require --dev szepeviktor/phpstan-wordpress
docker-compose exec wp composer require --dev phpstan/extension-installer
history
``` 