# Argus

社内 IT 機器の在庫・貸与管理システムです。

## 前提
- Docker / Docker Compose が使えること
- 作業ディレクトリはリポジトリルート（この `README.md` がある場所）

## ディレクトリ構成（初期）
- `docker/docker-compose.yml`: コンテナ定義
- `docker/Dockerfile`: `app`（php-fpm 8.3）イメージ
- `docker/web/default.conf`: `web`（nginx）設定
- `src`: Laravel アプリ本体
- `db`: MySQL 永続データ

## 初期設定手順
1. コンテナ起動
```bash
docker compose -f docker/docker-compose.yml up -d --build
```

2. `src/.env` 作成（未作成の場合）
```bash
cp src/.env.example src/.env
```

3. Composer 依存インストール
```bash
docker compose -f docker/docker-compose.yml exec app composer install
```

4. APP_KEY 生成
```bash
docker compose -f docker/docker-compose.yml exec app php artisan key:generate
```

5. マイグレーション実行
```bash
docker compose -f docker/docker-compose.yml exec app php artisan migrate
```

6. フロント依存インストールとビルド
```bash
docker compose -f docker/docker-compose.yml exec app npm install
docker compose -f docker/docker-compose.yml exec app npm run build
```

## アクセス
- アプリ: http://localhost:8080
- DB: `localhost:3306`
  - database: `argus`
  - user: `argus`
  - password: `secret`

## よく使うコマンド
- 停止
```bash
docker compose -f docker/docker-compose.yml down
```

- ログ確認
```bash
docker compose -f docker/docker-compose.yml logs -f
```

- テスト実行
```bash
docker compose -f docker/docker-compose.yml exec app php artisan test
```

## 補足
- タイムゾーンはコンテナ・アプリともに `Asia/Tokyo` を想定しています。
- DB データは `db/` に永続化されます。
