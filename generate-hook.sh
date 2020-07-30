#!/bin/bash
# variables
GIT_DIR=$(dirname $0)/.git
export $(cat $GIT_DIR/hooks/.GIT_PUSH_HOOK_CONFIG | grep REPOSITORY_BASE_BRANCH | xargs);


if [[ -d $GIT_DIR ]]; then
    echo "Directory exists!"
    mkdir $GIT_DIR/hooks
    echo $GIT_DIR/hooks/deploy.sh
    git config --local alias.dpush '!git push $1 $2 && if $2 = '"$REPOSITORY_BASE_BRANCH;then sh $GIT_DIR/hooks/deploy.sh;fi"

    cat <<'EOS' > $GIT_DIR/hooks/deploy.sh
#!bin/bash
# 設定ファイルから#以外をよみこむ
export $(cat $(dirname $0)/.GIT_PUSH_HOOK_CONFIG | grep -v ^# | xargs);

echo "Warning: pull to remote server, continue? [y/N]"
exec < /dev/tty
read ANSWER

case $ANSWER in "Y" | "y" | "yes" | "Yes" | "YES" ) echo "OK. pull start.";;
* ) echo "pull failed.";exit 1;;
esac

ssh -i $SSH_IDENTITY_FILE_PATH $SERVER_USER_NAME@$SERVER_HOST_NAME <<EOC
cd $GIT_PULL_DIR_PATH

if [[ -d $GIT_PULL_DIR_PATH ]]; then
  if [[ -d $GIT_PULL_DIR_PATH/.git ]]; then
    git clone $REPOSITORY_SSH_URL .
  else
    git pull origin $REPOSITORY_BASE_BRANCH
  fi
else
  echo "Server directory not exists..."
fi
EOC

exit 0
EOS
    chmod +x $GIT_DIR/hooks/deploy.sh
else
  echo "Directory not exists..."
    exit 1
fi
