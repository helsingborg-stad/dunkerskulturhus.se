<?php

/**
 * Use local varnish server.
 * @var string
 */
define('VHP_VARNISH_IP', '127.0.0.1');

/**
 * Use memcached.
 * @var bool
 */
if (!in_array(array_shift(explode(".", $_SERVER['HTTP_HOST'])), array("test", "beta"))) {
    define('WP_USE_MEMCACHED', false);
} else {
    define('WP_USE_MEMCACHED', false);
}

/**
* Memcache key salt
* @var string
*/
define('WP_CACHE_KEY_SALT', NONCE_KEY);

/**
 * Nginx helper, cache path.
 */
define('RT_WP_NGINX_HELPER_CACHE_PATH', '/var/lib/nginx/fastcgi_cache/');
