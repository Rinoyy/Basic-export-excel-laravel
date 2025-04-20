# Cara membuat export data excel paling mudah

### siapkan project laravel

buat project laravel dengan perintah

```
composer create-project laravel/lravel nama-projects
```

### install laravel excel

```
composer require "maatwebsite/excel:^3.1"

atau

composer require maatwebsite/excel
```

### membuat service export user

setelah memasukkan perintah di bawah ini, akan terbuat folder baru yaitu Exports didalam app

```
php artisan make:export UsersExport --model=User
```

### ubah kode export user

ubah kode userExport menjadi seperti di bawah ini.

```
class UsersExport implements FromCollection
{
    public function collection()
    {
        return User::all();
    }
}
```

### buat controller

dengan memasukkan perintah di bawah ini

```
php artisan make:controller UsersController
```

### ubah kode controller

```
class UsersController extends Controller
{
    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
```

### buka web.php didalam didalam folder routes

setelah kamu membuka foldernya akan ada web.php, lalu tambahkan kode di bawah ini

```
Route::get('users/export/', [UsersController::class, 'export']);
```

### buat seeder user

```
php artisan make:seeder UserSeeder
```

### uba kode didalam UserSeeder

```
public function run(): void
    {
        $faker = Faker::create();


        foreach (range(1, 10) as $i) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
            ]);
        }
    }
```

Daftar kan kedalam file DatabaseSeeder

```
    $this->call(UserSeeder::class);
```

### buka phpmyadmin

buka phpmyadmin, lalu buat database contoh dengan nama exportExcel

### buka file .env

buka file env karna kita akan melakukan konfigurasi pada Database, masukkan kode di bawah ini.

```
DB_CONNECTION=myqsl (jika anda pakai mysql)
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=exportExcel
DB_USERNAME=root
DB_PASSWORD= (jika anda punya password)
```

### Mari jalankan

-   php artisan migrate akan menjalankan table yang sudah di buat, dan akan masuk ke databse yang sudah kita buat.

-   php artisan db:seed ini akan menjalankan seeder atau data dummy yang sudah kita buat

-   php artisan server akan kita akan jalankan
