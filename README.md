# tdd-wordpress
Stolen from: 
https://marioyepes.com/wordpress-plugin-tdd-with-docker-phpunit/

- The Dockerfile has to be changed to the name of the plugin
There was an issue when trying to evoke phpunit and this helped:
https://www.smashingmagazine.com/2017/12/automated-testing-wordpress-plugins-phpunit/
- phpunit version bumped so it works with php8
- There were some spelling mistakes
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
docker-compose exec wp composer update
docker-compose exec wp composer phpunit
``` 