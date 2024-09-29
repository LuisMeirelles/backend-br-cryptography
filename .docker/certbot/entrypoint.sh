#!/bin/sh

DOMAIN=${SERVER_NAME}

# Verifica se o domínio é um domínio de teste
if [ "$ENVIRONMENT" = "development" ]; then
    echo "Usando certificado autoassinado para ${DOMAIN}..."

    # Gera um certificado autoassinado
    openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
        -keyout "/etc/ssl/private/selfsigned.key" \
        -out "/etc/ssl/certs/selfsigned.crt" \
        -subj "/CN=${DOMAIN}"

    echo "Certificado autoassinado gerado com sucesso!"

else
    if [ ! -f "/etc/letsencrypt/live/${DOMAIN}/fullchain.pem" ]; then
        echo "Certificado não encontrado. Gerando um novo certificado para ${DOMAIN}..."

        certbot certonly --standalone \
            -d "${DOMAIN}" --email "${EMAIL}" --agree-tos --non-interactive

        echo "Certificado gerado com sucesso!"
    else
        echo "Certificado já existe para ${DOMAIN}."
    fi
fi

trap exit TERM

while :; do
    /usr/local/bin/renew.sh
    sleep 12h
done
