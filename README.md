Test task for Future Binary Investments
========
Made by Oleksandr Bogdan

Installation:
-------------

1. Clone the project
```
git clone git@github.com:AlexanderBogdan/employee.git
```
2. Run installation
```
composer install
```
3. Auth0 parameters
```
auth0_base_url
auth0_domain
auth0_client_id
auth0_client_secret
```
Leave the default values when prompted during composer install

4. Generate database schema
```
php bin/console doctrine:schema:update --force
```
5. Load fixtures
```
php bin/console doctrine:fixtures:load
```
6. Run built-in Symfony server
```
php bin/console server:run
```
7. Open http://localhost:8000 
> IMPORTANT! 
> http://localhost:8000 is required for Auth0 service to work correctly.
> DO NOT USE http://127.0.0.1:8000 - Auth0 would not work

Run Unit Test:
-------------
```
./vendor/bin/phpunit
```
or, if phpunit installed globally:
```
phpunit
```

Description:
-------------

- Platform uses Symfony 3 and Doctrine 2.5
- Login is done using Auth0 oAuth server
- For communications with the database uses Symfony service AppBundle\Service\EmployeeManager
- oAuth server integration is done in separate bundle (Obogdan\OAuthUserBundle) which is a copmoser dependency
[Link to GitHub repo](https://github.com/AlexanderBogdan/OAuthUserBundle)
- Unit test is located at tests/AppBundle/Entity/EmployeeEntityTest.php,
test ensures that Employee's entity gender can be either "m" or "f" or NULL.
 In other cases InvalidArgumentException is thrown.
