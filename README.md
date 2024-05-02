# InternNet

## Cloner le repo git
- git clone https://github.com/NataBoud/ECF02-NataliaBoudard-InternNet.git
- `cd InternNet`
- `composer install`
- Configurer la base de données :
  ```.env
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=internnet
  DB_USERNAME=root
  DB_PASSWORD=
  ```
- `php artisan key:generate`
- `php artisan serve`
- `php artisan migrate`
- `php artisan serve`
- `npm i`
- `npm run dev`

## Démarrage du projet
- laravel new InternNet
- cd InternNet
- php artisan serve
- https://laravel.com/docs/11.x/eloquent#generating-model-classes
- utilisation scout Laravel pour le moteur de recherche
- https://laravel.com/docs/11.x/scout#main-content
