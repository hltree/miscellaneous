FROM ubuntu:16.04

RUN apt-get update
RUN apt-get install -y apt-utils
RUN apt-get install -y cron
RUN apt-get install -y sudo

COPY task.sh /usr/local/bin/
COPY cron-example /etc/cron.d/
RUN sudo chmod 0644 /etc/cron.d/cron-exsample

CMD ["cron", "-f"]
