# 技術要件・実装方針
## 1. 技術要件

### 1.1 バックエンド
- Framework: Laravel 12 (`laravel/framework:^12.0`)
- Language: PHP 8.3（運用コンテナ基準。`composer.json` は `^8.2`）
- Package Manager: Composer 2

### 1.2 フロントエンド
- Template: Blade
- Build Tool: Vite
- Style: Tailwind CSS 4（Vite プラグイン経由）
- JavaScript: `resources/js/app.js` をエントリとして利用

### 1.3 実行環境
- Container: Docker / Docker Compose
- Web: Nginx 1.27-alpine
- App: php-fpm (php:8.3-fpm)
- Timezone: `Asia/Tokyo`（コンテナ環境変数）

### 1.4 データベース
- DB: MySQL 8.4


## 2. ディレクトリ/責務
- `docker`: Docker関連のファイルを管理
- `src/app/Models`: テーブル構造を表現する Eloquent モデル
- `src/app/Repositories`: DBアクセス（検索/集計/保存）を集約
- `src/app/Actions`: ユースケース・ドメインロジック
- `src/app/Http/Controllers`: 入力済みデータを使って View 用に整形
- `src/app/Http/Requests`: 入力バリデーションと正規化
- `src/resources/views`: 表示（Blade）
- `src/app/Console/Commands`: 定期処理・手動実行バッチ
- `db`: MysqlコンテナでのDBのマウント先

## 3. レイヤー実装ルール
- 依存方向は `Controller -> Action -> Repository -> Model` を維持する。
- Controller から直接クエリを書かない（DB操作は Repository 経由）。
- Action は複数 Repository の調停、外部API呼び出し、業務ルール適用を担当する。
- Repository はデータ取得/保存に専念し、画面都合の整形は行わない。
- Request クラスで以下を完了させてから Controller に渡す。
1. 必須/形式チェック
2. デフォルト値の補完
3. 相関バリデーション（例: 期間上限183日、`y_min < y_max`）

## 4. コーディングルール

### 4.1 PHP実装
- コンストラクタDIを標準とする。
- 戻り値型を明示し、`Collection`, `?Model`, `array` などを使い分ける。
- 日時は `CarbonImmutable` を優先し、タイムゾーンは `Asia/Tokyo` を明示する。
- 例外/失敗の扱いを明確にする。
1. 業務継続不能は `FAILURE` を返却（Command）
2. 通知失敗など非本質処理は warn ログ化し処理継続
- 外部サービス設定は `config/services.php` 経由で参照し、アプリコードで `env()` を直接呼ばない。

### 4.2 モデル
- `fillable` を必ず定義する。
- 数値/日時カラムは `casts` で型変換を定義する。
- `created_at/updated_at` を持たないテーブルは `$timestamps = false` を設定する。

### 4.3 View / JS
- View は表示責務に限定し、複雑な計算は Action 側で完了させる。
- フィルタ入力値は再描画時に保持（`old()` + 選択値）する。
- グラフ描画の入力データは JSON で受け渡し、描画ロジックはJS側で完結させる。

## 5. テスト方針
- Featureテストを中心に HTTP 入力/出力の挙動を担保する。
- DB テストは `RefreshDatabase` + sqlite in-memory（`phpunit.xml`）を標準とする。
- 最低限の検証対象:
1. 期間フィルタ（単日/期間）
2. 入力バリデーション（期間上限、不正 city_id、Y軸範囲）
3. 都市切替時の表示データ整合

## 6. 運用ルール
- Laravel ソースは Docker イメージに COPY せず、compose volume マウントで扱う。
- `app`, `web`, `db` はコンテナ分離する。
- DB データは `db/` マウントで永続化する。
- 権限エラー時は `storage/` と `bootstrap/cache/` の所有者・権限を修正する。

## 7. 変更時チェックリスト
1. レイヤー責務違反（Controller直クエリ等）がないか
2. Request バリデーションで入力境界をカバーできているか
3. 主要ユースケースのFeatureテストを追加/更新したか
4. 環境変数追加時に `config/*.php` とドキュメントを更新したか
