# git-push-hook

## Overview

シェルスクリプトで同階層の `.git` の中にhookを生成します。

hookは `git push` 時に `.git-push-hook-config` に設定された環境にコマンドを入力させます。

## Usage

### 1. .git-push-hook-config(設定ファイル)を.git内にコピーしてください

```
$ cp .git-push-hook-config.sample .git/.git-push-hook-config
```

### 2. 1で作成したファイルとshファイルを移動させてください

1で作成した `.git-push-hook-config` と `generate-hook.sh` を適用させたいgitリポジトリのディレクトリに移動させてください。

```
$ mv .git-push-hook-config generate-hook.sh ${target}
```

### 3. 
