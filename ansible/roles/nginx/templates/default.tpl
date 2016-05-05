server {
    listen 80;

    server_name wordpress;
    root        {{ doc_root }};

    error_log   /var/log/nginx/wordpress/error.log;
    access_log  /var/log/nginx/wordpress/access.log;

    location / {
        index       index.php;
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ ^/.+\.php(/|$) {
        fastcgi_pass            unix:/var/run/php5-fpm.sock;
        fastcgi_buffer_size     16k;
        fastcgi_buffers         4 16k;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include                 fastcgi_params;
        fastcgi_param           SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param           HTTPS           off;
    }
}
