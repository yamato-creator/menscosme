# メンズコスメ｜口コミサイト

「メンズコスメをもっと簡単に探したい」をコンセプトにした情報共有アプリです。  
商品のクチコミ、ユーザー同士のコミュニケーションを通じて、男性向け化粧品・美容に関しての情報を共有できます。  

URL: https://menscosme.site  

<img width="1100" alt="イメージ図" src="https://user-images.githubusercontent.com/63177307/104813967-b5c24300-584f-11eb-8a91-b801eaeb38b3.png">

## 作成した経緯
私は男性ですが普段、化粧をすることがあります。  
男性向けの化粧品情報はまだ少なく、身近に男性で化粧をしている人も居なかったため、情報を共有することができませんでした。  
そこで、主に男性向けの化粧品情報を共有できるアプリがあれば良いなと考え、作成しました。  

## 機能一覧
### ユーザー機能
- 新規登録、ログイン、ログアウト
- ユーザー登録・編集・削除
- ユーザー一覧表示
- ユーザーのフォロー・フォロー解除
- マイページにて以下の投稿の一覧表示
    - 全ての自分の投稿
    - フォロー数、フォロワー数、ツイート数
    - お気に入りに追加した投稿
### 管理者機能(商品登録機能)
- 新しく商品を登録・編集・削除
- 画像切り抜き、画像アップロード(S3に保存)・削除
### ツイート投稿機能
- 投稿・編集・削除
- 一覧表示、詳細表示
- お気に入り追加（いいね数のカウント）
- 検索（キーワード検索）
### コメント機能
- 投稿,表示
### その他
- レスポンシブ対応
- テスト
 
## 使用技術
### フロントエンド
- HTML
- CSS
- bootstrap
- JavaScript
- jQuery


### バックエンド
- PHP 7.2.33
- Laravel 7.30.0
- PHPUnit

### インフラストラクチャー
- MySQL 5.7.32
- Nginx 1.15
- PHP-FPM
- Docker 20.10.0/docker-compose 1.27.4
- CircleCI(CI/CD)
- AWS

### AWS
    - EC2
    - RDS
    - IAM
    - S3
    - VPC
    - ALB
    - ACM
    - Route53
    - CodeDeploy
    - CodeCommit
    - CodeBuild
    - CodePipeline
    - SNS
    - Chatbot

### その他
- Slack(AWSでビルド、デプロイ成功でSlackに通知)

## インフラ構成図
<img width="819" alt="インフラ構成図" src="https://user-images.githubusercontent.com/63177307/104436539-142dbe00-55d1-11eb-92b0-0d2f5a1e49ad.png">

## ER図
<img width="635" alt="ER図" src="https://user-images.githubusercontent.com/63177307/104438263-24469d00-55d3-11eb-80ca-f46739393101.png">

