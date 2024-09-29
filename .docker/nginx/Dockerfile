FROM nginx:alpine

ARG SERVER_NAME
ARG ENVIRONMENT

COPY default.conf.template /etc/nginx/conf.d/default.conf.template
COPY ssl-params.conf /etc/nginx/snippets/ssl-params.conf

COPY wait-for-certbot.sh /usr/share/nginx/wait-for-certbot.sh

RUN if [ "$ENVIRONMENT" = "production" ]; then \
        echo "Usando certificados Let’s Encrypt"; \
        export SSL_CERTIFICATE_PATH=/etc/letsencrypt/live/${SERVER_NAME}/fullchain.pem; \
        export SSL_CERTIFICATE_KEY_PATH=/etc/letsencrypt/live/${SERVER_NAME}/privkey.pem; \
    else \
        echo "Usando certificados autoassinados"; \
        export SSL_CERTIFICATE_PATH=/etc/ssl/certs/selfsigned.crt; \
        export SSL_CERTIFICATE_KEY_PATH=/etc/ssl/private/selfsigned.key; \
    fi && \
    # Comando para gerar o arquivo de configuração do Nginx
    envsubst '$SERVER_NAME $SSL_CERTIFICATE_PATH $SSL_CERTIFICATE_KEY_PATH' \
    < /etc/nginx/conf.d/default.conf.template \
    > /etc/nginx/conf.d/default.conf
