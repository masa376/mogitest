## 環境構築

### Dockerビルド
1. `git clone git@github.com:Estra-Coachtech/laravel-docker-template.git`
2. `docker-compose up -d --build`



### Laravel環境構築
1. `docker-compose exec php bash`
2. `composer install`
3. `.env.example` ファイルから `.env` を作成し、環境変数を変更
4. `php artisan key:generate`
5. `php artisan migrate`

---

## 使用技術
- PHP 8.0
- Laravel 10.0
- mysql:8.0.26

---

## URL
- 開発環境 : [http://localhost/8051](http://localhost/8051)  
- phpMyAdmin : [http://localhost:8080/](http://localhost:8080/)


