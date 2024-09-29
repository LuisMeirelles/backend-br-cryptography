FROM certbot/certbot

ARG SERVER_NAME
ARG EMAIL

ENV SERVER_NAME=${SERVER_NAME}
ENV EMAIL=${EMAIL}

COPY renew.sh /usr/local/bin/renew.sh
COPY entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/renew.sh /usr/local/bin/entrypoint.sh

RUN mkdir -p /usr/share/nginx/html/.well-known/acme-challenge

RUN apk add --no-cache openssl
