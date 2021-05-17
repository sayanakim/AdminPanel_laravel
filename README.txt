
    https://www.youtube.com/watch?v=MQw2Y_W3UlI

    СОЗДАНИЕ РЕГИСТРАЦИИ/АУТЕНТИФИКАЦИИ

    НАСТРОЙКА ПРОЕКТА

1. create laravel project

2.  Создаем БД admin-panel

3.  php artisan make:model Post -m
    php artisan make:model Category -m

4.  Добавляем поля в миграции

5.  Пакет регистрации и аутентификации:
        -composer require laravel/fortify
        -php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"

6.  php artisan migrate

7.  Пакет laravel ui:
        -composer require laravel/ui

8.  Пакет для установки стилей:
        -php artisan ui bootstrap --auth




        ДОБАВЛЕНИЕ РОЛЕЙ пользователя с помощью laravel-permission

https://spatie.be/docs/laravel-permission/v4/installation-laravel

1. Пакет прав доступа:
        -composer require spatie/laravel-permission

2. config/app.php:
        'providers' => [
             // ...
             Spatie\Permission\PermissionServiceProvider::class,
         ];

3. Console:
    - php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"

4. php artisan migrate

5. добавление ролей в БД:

https://spatie.be/docs/laravel-permission/v4/basic-usage/artisan
           - php artisan permission:create-role user
           - php artisan permission:create-role admin

6. Добавляем App\Models\User.php:    HasRoles
    Этот пакет позволяет связывать пользователей с разрешениями и ролями.

        use Spatie\Permission\Traits\HasRoles;

        class User extends Authenticatable
        {
            use HasFactory, Notifiable, HasRoles;

7. App\Http\Controllers\Auth\RegisterController:

    protected function create(array $data)
        {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
            $user->assignRole('user');  # задает роль 'user' зарегистрированным пользователям
            return $user;
        }

8. добавить их в свой app/Http/Kernel.php файл.

       protected $routeMiddleware = [
           // ...
           'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
           'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
           'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,
       ];

9. Маршрут для страницы(пример) с доступом только админу:

https://spatie.be/docs/laravel-permission/v4/basic-usage/middleware

        Route::group(['middleware' => ['role:admin']], function () {
           Route::get('/test', function () {
                   return view('test');
       });




        СОЗДАНИЕ МАКЕТА АДМИН-ПАНЕЛИ С ПОМОЩЬЮ ADMINLTE

1. Скачиваем AdminLTE:
        https://github.com/ColorlibHQ/AdminLTE/releases

2. создаем отдельную папку admin(view and controller)



