# syntax=docker/dockerfile:1.4

FROM --platform=$BUILDPLATFORM php:7.2-apache as builder
CMD ["apache2-foreground"]

FROM builder as dev-envs

RUN <<EOF
apt-get update
apt-get install -y --no-install-recommends git
EOF

RUN <<EOF
useradd -s /bin/bash -m vscode
groupadd docker
usermod -aG docker vscode
EOF
# install Docker tools (cli, buildx, compose)
COPY --from=gloursdocker/docker / /

CMD ["apache2-foreground"]

# install msqli 

#RUN docker-php-ext-install mysqli 
#RUN docker-php-ext-enable mysqli
#RUN docker-php-ext-install pdo_mysql 


#FROM php:8.0.9-apache
#WORKDIR /var/www/html
#RUN docker-php-ext-install mysqli pdo pdo_mysql
#RUN docker-php-ext-enable mysqli