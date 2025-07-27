#お問い合わせフォーム
##環境構築
###Dockerビルド
1.git clone git@github.com:coachtech-material/laravel-docker-template.git
2.mv laravel-docker-template test_contact-form
3.docker-compose up -d --build

###Laravel環境構築
1.composer install
2.cp .env.example .env
3.php artisan key:generate

コントローラ
1.php artisan make:controller ContactController
2.php artisan make:controller AuthController
3.php artisan make:controller CsvDownloadController

マイグレーション
1.php artisan make:migration create_contact_table
2.php artisan make:migration create_categories_table
3.php artisan migrate

モデル
1.php artisan make:model Contast
2.php artisan make:model Category

シーディング
1.php artisan make:seeder CategoriesTableSeeder
2.php artisan db:seed

##使用技術
・PHP  7.4.9
・Laravel Framework 8.83.8
・Mysql 8.0.26

##ER図
![Alt text](/src/database/image/ER.png)

##URL
・開発環境：<http://localhost/>
・phpMyAdmin：<http://localhost:8080/>
