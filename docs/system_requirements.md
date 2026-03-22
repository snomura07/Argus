# 社内IT機器 在庫・貸与管理システム 要件整理

---

## ■ 概要

社内のIT機器（PC、モニター、キーボード、マウス等）の在庫および貸与状況を管理するWebアプリケーションを構築する。

* 在庫数の管理
* 貸与状況の管理（誰に何を何台）
* 個体管理（主にPC）と数量管理（その他機器）を両立する

---

## ■ 設計方針（重要）

### 1. artifact = 品目（管理単位）

* artifactは「同一として扱う単位（スペック単位）」とする
* モデル名ではなく、**運用上区別したい粒度で分ける**

例：

* Dell Latitude 5440 / i5 / 16GB / 14inch → 1 artifact
* Dell Latitude 5440 / i5 / 8GB / 14inch → 別 artifact

---

### 2. 個体管理と数量管理の統一

* PC：個体管理（unitテーブルで管理）
* その他機器：数量管理（stockテーブルで管理）

ただし、すべて artifact を起点に統一する

---

### 3. 属性の分離

| 種類   | 内容            | 保持場所     |
| ---- | ------------- | -------- |
| スペック | CPU、メモリ、画面サイズ | artifact |
| 個体差  | 管理番号、入荷日、保証   | unit     |
| 在庫数  | 利用可能数、開封/未開封  | stock    |

---

## ■ 機能要件

### ・在庫管理

* artifact単位で在庫数を管理
* 在庫数 = 利用可能数
* 開封済み / 未開封を区別

### ・貸与管理

* 誰に何を何台貸与しているか管理
* 貸与先は以下を含む

  * 人
  * 課
  * 会議室
  * プロジェクト

### ・貸与種別

* 貸与（通常）
* 一時貸出（期限付き・申請あり）

### ・状態管理

* 在庫
* 貸与
* 一時貸出
* 故障
* 修理中
* 廃棄

---

## ■ UI方針（重要）

* artifactは**選択式（検索）で入力**
* 存在しない場合のみ新規作成
* 自由入力は極力避ける

---

## ■ テーブル設計

---

## artifacts（品目マスタ）

```sql
id                BIGINT PK
artifact_type     VARCHAR  -- pc / monitor / keyboard / mouse
name              VARCHAR  -- 表示用（例：Dell Latitude 5440 / i5 / 16GB / 14inch）

-- スペック情報
maker             VARCHAR
model             VARCHAR
cpu               VARCHAR
memory_gb         INT
storage_gb        INT
display_size      VARCHAR

created_at        DATETIME
updated_at        DATETIME
```

---

## pc_units（PC個体管理）

```sql
id                BIGINT PK
artifact_id       BIGINT FK -> artifacts.id

management_no     VARCHAR  -- kepc0001など
status            VARCHAR  -- 在庫 / 貸与 / 故障 / 修理中 / 廃棄

received_at       DATE
warranty          BOOLEAN

created_at        DATETIME
updated_at        DATETIME
```

---

## artifact_stock（在庫数管理）

```sql
artifact_id       BIGINT PK FK -> artifacts.id

opened_count      INT  -- 開封済み
unopened_count    INT  -- 未開封

updated_at        DATETIME
```

※ available_count は
opened_count + unopened_count で算出

---

## assignees（貸与先マスタ）

```sql
id                BIGINT PK
name              VARCHAR

assignee_type     VARCHAR
-- person / department / room / project

created_at        DATETIME
updated_at        DATETIME
```

---

## lending（貸与管理）

```sql
id                BIGINT PK

artifact_id       BIGINT FK -> artifacts.id
assignee_id       BIGINT FK -> assignees.id

quantity          INT

lending_type      VARCHAR
-- normal / temporary

start_date        DATE
end_date          DATE

created_at        DATETIME
updated_at        DATETIME
```

---

## ■ データの関係

```
artifact（品目）
  ├─ pc_units（個体）※PCのみ
  ├─ artifact_stock（在庫数）
  └─ lending（貸与）
```

---

## ■ データ例

### PC（同一スペック5台）

* artifacts：1件
* pc_units：5件
* artifact_stock：opened_count = 5

---

### モニター（4台）

* artifacts：1件
* artifact_stock：unopened_count = 4

---

## ■ 設計上のポイントまとめ

* artifactは「モデル」ではなく「管理単位」
* 個体差はunitで管理する
* 在庫は数量としてstockで管理する
* 貸与はartifact単位で数量管理する
* UIは選択ベースにすることで重複を防ぐ

---

## ■ 将来拡張

* 貸与履歴の保持
* artifact統合機能（重複対策）
* 在庫差異チェック機能
* 権限管理

```
```
