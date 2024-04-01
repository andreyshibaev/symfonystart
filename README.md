## Symfony starter
1. git clone https://github.com/andreyshibaev/symfonystart.git
2. cd symfonystart
3. composer install
4. npm install
5. npm run dev
6. create a local new database
7. php bin/console make:migration
8. php bin/console doctrine:migrations:migrate
9. php bin/console create-secret-key
10. copy the file ".env" and rename it to ".env.local"
11. add the generated key to the file ".env.local"
12. php bin/console assets:install
13. composer dump-env prod for production
14. composer require symfony/apache-pack for production
15. composer require symfony/rate-limiter