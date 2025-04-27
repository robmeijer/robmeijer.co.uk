# syntax=docker/dockerfile:1
FROM ghcr.io/robmeijer/php:8.4-frankenphp AS app

ARG USER_ID=33
ARG GROUP_ID=33

ENV APP_ENV=prod XDEBUG_MODE=off

COPY --link --chown=${USER_ID}:${GROUP_ID} app/composer.* app/symfony.lock ./

RUN composer install --ignore-platform-reqs --no-cache --no-dev --no-interaction --no-progress --no-scripts

COPY --link --chown=${USER_ID}:${GROUP_ID} app ./

RUN set -eux; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer dump-env prod; \
    composer run-script --no-dev post-install-cmd; \
    chmod -R 777 var;

COPY --link --chmod=755 docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint

ENTRYPOINT ["docker-entrypoint"]
CMD [ "frankenphp", "run", "--config", "/etc/caddy/Caddyfile" ]

FROM app AS local

USER root

RUN set -eux; \
    install-php-extensions xdebug; \
    ln -sf "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"; \
    usermod -u ${USER_ID} www-data && groupmod -g ${GROUP_ID} www-data; \
    chown -R www-data:www-data /data/caddy && chown -R www-data:www-data /config/caddy; \
    chown -R www-data:www-data /var/www;

USER www-data
