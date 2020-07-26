FROM ubuntu:latest

ARG DEBIAN_FRONTEND=noninteractive
RUN apt update
RUN apt update -y --fix-missing
RUN apt upgrade -y
RUN apt install -y sqlite3
RUN apt install -y php7.4
RUN apt install -y php7.4-fpm
RUN apt install -y php-sqlite3
RUN apt install -y nginx
RUN apt autoremove -y

COPY ./nginx_conf /etc/nginx/sites-available/default
RUN chmod 747 /etc/nginx/sites-available/default

EXPOSE 80/tcp
EXPOSE 80/udp

VOLUME /var/www/html/

VOLUME /database

ADD container_start.sh /
RUN chmod 747 /container_start.sh

CMD ["/container_start.sh"]