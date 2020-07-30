#!/bin/bash

GIT_DIR=$(dirname $0)/.git

if [[ -d $GIT_DIR ]]; then
    echo "Directory exists!"
    mkdir $GIT_DIR/hooks
    cat <<'EOS' > $GIT_DIR/hooks/pre-push
#!/bin/bash

echo '[warn] push to remote, continue? [y/N]'

exec < /dev/tty
read answer

case $answer in
    'y' | 'yes') echo '[info] OK. push start.';;
    * ) echo '[error] push failed.';exit 1;;
esac
exit 0
EOS
    chmod +x $GIT_DIR/hooks/pre-push
    exit 0
else
  echo "Directory not exists..."
    exit 1
fi
