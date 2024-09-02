# Atte（勤怠管理システム）

勤怠管理システムを作成しました。  ログイン後、ボタン押下で勤務開始/終了時間と休憩開始/終了時間を管理します。

![alt text](stamp.png)

## 作成した目的

学習のアウトプットとして作成

## アプリケーションURL

作成中

## 機能一覧
- ログイン機能
- メール認証
- 勤務状態によるボタン制御
- 勤務時間/休憩時間管理
- 日付別勤怠管理
- ユーザー一覧
- ユーザー別勤怠管理



## 仕様技術
- PHP8.3.8
- Laravel8.83.27
- MySQL8.0.26



## テーブル設計
![alt text](<スクリーンショット 2024-08-19 17.48.57.png>)



## ER図
![alt](Atte.png)



## 環境構築
**Dockerビルド**
1. `git@github.com:Shinji-0323/Atte.git`
2. DockerDesktopアプリを立ち上げる
3. `docker-compose up -d --build`



**Laravel環境構築**
1. `docker-compose exec php bash`
2. `composer install`
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成
4. .envに以下の環境変数を追加
``` text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```
5. アプリケーションキーの作成
``` bash
php artisan key:generate
```

6. マイグレーションの実行
``` bash
php artisan migrate
```

7. シーディングの実行
``` bash
php artisan db:seed
```


## URL
- 開発環境：http://localhost/
- phpMyAdmin：http://localhost:8080/
- MailHog：http://localhost:8025/