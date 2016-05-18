map $uri $blogname{
    ~^(?P<blogpath>/[^/]+/)files/(.*)       $blogpath ;
}

map $blogname $blogid{
    default -999;

    #Ref: http://wordpress.org/extend/plugins/nginx-helper/
    #include /var/www/wordpress/wp-content/plugins/nginx-helper/map.conf ;
}

server {
	server_name nuitdebout;
	root {{doc_root}};

	index index.php;

	include global/restrictions.conf;

    error_log   /var/log/nginx/error.log;
    access_log  /var/log/nginx/access.log;

	# Additional rules go here.

    # Proxy non-HTTPS requests from tvdebout.thekey.pw to avoid mixed content errors
    location ~* ^/tvdebout/repu_[^/]*/[0-9]+\.ts$ {
        proxy_cache off;
        rewrite ^\/tvdebout\/(repu_[^\/]*)\/([0-9]+\.ts)$ /hls/$1/$2 break;
        proxy_pass http://tvdebout.thekey.pw;
    }
    location ~* ^/tvdebout/ {
        proxy_cache off;
        expires -1;
        rewrite ^/tvdebout/(.*) /hls/$1 break;
        proxy_pass http://tvdebout.thekey.pw;
    }

	include global/multisite.conf;
}
