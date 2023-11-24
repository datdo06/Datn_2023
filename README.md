Tạo file migration
- php artisan make:migration create_tests_table (lệnh tạo bảng)

Đồng bộ file migration
- php artisan migrate

Xóa file file migration
- php artisan migrate:rollback

Tạo dữ liệu mẫu test
- php artisan db:seed

tạo dữ liệu mẫu và reset toàn bộ
- php artisan migrate:fresh --seed

Tạo controller  bằng lệnh
- php artisan make:controller TestController

Tạo model bằng lệnh
- php artisan make:model Flight

chèn route vào model
- Route::get('/user', 'TestController@index');


thêm đoạn này vào để fix lỗi không nhận controller
trong RouteServiceProvider
- protected $namespace = 'App\Http\Controllers';

Tạo ra từng seed riêng ứng với db

php artisan make:seeder StudentsSeeder (Ví dụ tạo seed dành cho bảng user )

Sử dụng factory để tạo dữ liệu mẫu

php artisan make:factory StudentsFactory --model=Students

Lệnh tạo Request
- php artisan make:request StudentRequest

Tạo controler resouce
- php artisan make:controller ProductController --api
- php artisan make:resource ProductResource
- php artisan route:list --name=products
