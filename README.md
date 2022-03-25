Symfony starter
--
1. git clone https://github.com/andreyshibaev/symfonystart.git
2. cd symfonystart
3. composer install
4. composer update
5. npm install
6. npm run dev
7. create a local new database
8. php bin/console doctrine:migrations:migrate
9. php bin/console app:generate-secret-key
10. copy the file ".env" and rename it to ".env.local"
11. add the generated key to the file ".env.local"