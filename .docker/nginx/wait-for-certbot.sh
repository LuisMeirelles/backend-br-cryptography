#!/bin/bash

while [ ! -f "/etc/letsencrypt/live/${SERVER_NAME}/fullchain.pem" ] && [ ! -f "/etc/ssl/certs/selfsigned.crt" ]; do
    echo "Waiting for SSL certificates..."
    sleep 5
done

echo "Certificates found, starting NGINX..."
nginx -g "daemon off;"
