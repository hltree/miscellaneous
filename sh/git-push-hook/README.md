# git-push-hook

## Overview

シェルスクリプトで同階層の `.git` の中にhookを生成します。

hookは `git push` 時に `.GIT_PUSH_HOOK_CONFIG` に設定された環境にコマンドを入力させます。

## Usage

### 1. .GIT_PUSH_HOOK_CONFIGの設定ファイルを作成してください

.GIT_PUSH_HOOK_CONFIG.sampleをリネームし、.gitのhook内にコピーしてください

```
$ cp .GIT_PUSH_HOOK_CONFIG.sample .git/.GIT_PUSH_HOOK_CONFIG
```

設定値を適切に入力してください。

|キー|説明|
|---|---|
|REPOSITORY_SSH_URL|クローンに利用。リポジトリのSSHクローンURL。|
|REPOSITORY_BASE_BRANCH|プルに利用。リポジトリのベースブランチ名。|
|SERVER_HOST_NAME|サーバーのホスト名|
|SERVER_USER_NAME|サーバーのユーザ名|
|SSH_IDENTITY_FILE_PATH|クライアント側。サーバーに接続するための秘密鍵のパス|
|GIT_PULL_DIR_PATH|デプロイ先ディレクトリのパス|

### 2. 1で作成したファイルとshファイルを移動させてください

`generate-hook.sh` を.gitディレクトリに移動させてください。

```
$ mv .GIT_PUSH_HOOK_CONFIG generate-hook.sh ${target}
```

### 3. generate-hook.shを実行する

```
$ sh generate-hook.sh
```

実行後は破棄してよいです

### 4. 新しいコマンドでテストプッシュする

下記のコマンドでプッシュしてみます。

```
$ git dpush origin master
```

リモートサーバーにプルを実行させるのか確認されます。

![](https://user-images.githubusercontent.com/35206336/88896298-9d9c3e80-d284-11ea-8e69-4622ceda22be.png)

実行させる場合は`y`を、させない場合は`n`を入力してください。


aliasが下記の通りに登録されているはずです。

```
[alias]
    dpush = !git push $1 $2 && sh ./.git/hooks/deploy.sh
```
