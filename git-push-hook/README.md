# git-push-hook

## Overview

シェルスクリプトで同階層の `.git` の中にhookを生成します。

hookは `git push` 時に `.GIT_PUSH_HOOK_CONFIG` に設定された環境にコマンドを入力させます。

## Usage

### 1. .GIT_PUSH_HOOK_CONFIGの設定ファイルを作成してください

.GIT_PUSH_HOOK_CONFIG.sampleをリネームし、.git内にコピーしてください

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

1で作成した `.GIT_PUSH_HOOK_CONFIG` と `generate-hook.sh` を適用させたいgitリポジトリのディレクトリに移動させてください。

```
$ mv .GIT_PUSH_HOOK_CONFIG generate-hook.sh ${target}
```

### 3. generate-hook.shを実行する

```
$ sh generate-hook.sh
```

実行後は破棄してよいです

### 4. 新しいコマンドでテストプッシュする

```
$ git dpush origin master
```

これで設定されたサーバーにデプロイされました。

aliasが下記の通りに登録されているはずです。

```
[alias]
    dpush = !git push $1 $2 && sh ./.git/hooks/deploy.sh
```