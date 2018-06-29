#!/usr/bin/env bash

wget -O /tmp/docker.sh http://get.docker.com;
bash /tmp/docker.sh;
sudo apt-get install -y python3-pip;
sudo pip3 install docker-compose

docker pull composer
docker pull php
docker pull nginx
sudo docker-compose up -d



