# Atte（勤怠管理システム）

勤怠管理システムを作成しました。  
ログイン後、ボタン押下で勤務開始/終了時間と休憩開始/終了時間を管理します。

![alt text](stamp.png)

## 作成した目的

学習のアウトプットとして作成

## アプリケーション URL

### 開発環境
- ローカル：http://localhost/  
  アプリケーションにアクセスするためのURL。
- phpMyAdmin：http://localhost:8080/  
  データベースを管理するためのツール。
- MailHog：http://localhost:8025/  
  開発用のメールキャッチャー。

### 本番環境
- ロードバランサー（現在停止中）：http://atte-web-lb-1252239849.ap-northeast-1.elb.amazonaws.com
※現在はカスタムドメイン未設定

## 機能一覧

- **ログイン機能**：ユーザーはログインして勤怠情報を管理可能。
- **メール認証**：ユーザー登録時にメール認証を必須化。
- **勤務状態によるボタン制御**：勤務中/休憩中に応じて適切な操作ボタンを表示。
- **勤務時間/休憩時間管理**：ボタン操作で勤務・休憩時間を記録。
- **日付別勤怠管理**：日付ごとの勤怠記録を確認。
- **ユーザー一覧**：全ユーザーの勤怠情報を管理者が確認可能。
- **ユーザー別勤怠管理**：個別のユーザー勤怠記録を管理。

## 仕様技術

- **バックエンド**
  - PHP7.4.9
  - Laravel8.83.27
  - MySQL8.0.26（ローカル環境）
  - MySQL8.0.26（Docker環境）

- **フロントエンド**
  - Nginx1.21.1

- **開発環境**
  - Docker/Docker-compose

- **デプロイ環境**
  - AWS
    - VPC
    - EC2
    - RDS
    - S3
    - ロードバランサー

## テーブル設計

以下のテーブル設計は、本システムにおける勤怠管理データの保存形式を示しています。

![alt text](<スクリーンショット 2024-08-19 17.48.57.png>)

## ER 図

下記はシステムのエンティティ間の関係を示したER図です。

![alt](Atte.png)

## 環境構築

**Docker ビルド**

1. `git@github.com:Shinji-0323/Atte.git`
2. DockerDesktop アプリを立ち上げる
3. `docker-compose up -d --build`このコマンドでDockerコンテナを起動し、必要な環境を構築します。

**Laravel 環境構築**

1. `docker-compose exec php bash`
2. `composer install`
3. `cp .env.example .env`　このコマンドで「.env.example」を 「.env」にコピー
4. `.env` ファイルを設定してください（例として以下を参考にしてください）

```text
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションキーの作成

```bash
php artisan key:generate
```

6. マイグレーションの実行

```bash
php artisan migrate
```

7. シーディングの実行

```bash
php artisan db:seed
```

## メール認証の環境構築

このアプリケーションでは、**メール認証**をしています。以下の手順に従って環境を構築してください。

### **Mailhogの設定**

1. Dockerコンテナをビルドする際、Mailhogが自動的に起動します。
- Mailhogは `http://localhost:8025/` でアクセス可能です。

2. Laravelの `.env` ファイルにメール送信の設定を記載します。

```text
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=example@example.com
MAIL_FROM_NAME="${APP_NAME}"
```