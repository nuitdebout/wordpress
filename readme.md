# Site portail nuitdebout.fr 

Utilise WordPress multisites.

> utilisé pour faire le lien entre les differents outils disponibles (wiki, chat, )
> faire le lien vers les comptes sociaux (FB, twitter, periscope, etc..)
> destiné à pouvoir etre utilisé par chaque ville qui le souhaite (son propre site)
> peut servir de base de redirection pour les villes ayant leur propre site deja en place
> "juste" le theme peut être utilisé par les villes ayant un wordpress mais avec un theme generique 

exemple: nuitdebout.fr/marseille (utilisation de répertoire statué sur loomio)

> utilise un "theme" commun qui peut etre largement modifié et adapté avec ses propres liens et contenus

## Using default configuration file

```
<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'nuitdebout2');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
  * N'y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'bgR#8O5o}@ejO%@4J5qJ@scBEpVoENHeq;Fe|ey%Qz?!D43sy$YD7^=ouDie6rH4');
define('SECURE_AUTH_KEY', 'O9o=:u_Y]/o:^#Q}FV67C^h?#Mb|olj-D7+C,1 {|O>X)y$ige2wyMxs*F? O[O');
define('LOGGED_IN_KEY', '}zov(N`#}o}60xj6*P c`.O4_,T=V^G?UyZ+&[G]ri s)`jUtJ (K_9y?5F/b!X4');
define('NONCE_KEY', 'J~gMwWQ*{3X2<^G5k&O[A#yJ>5u|4+X9col]u.HkI!SqDYOT0a0d1]cyvlj(g/vF');
define('AUTH_SALT', 'r$9[Q`^$2WQ-U80Hq(:G=ip!TDoXR&A%-^>9-e/_!;x;atJnUNg$hOzY`pRdQ%K2');
define('SECURE_AUTH_SALT', '?42^c#w9%=Hi1zF1ttKJJ4`8|p2U/3XS)GE.h&90wT=6F0.hsaQ+<Qa@ZH6_OeDe');
define('LOGGED_IN_SALT', 'Fwa^3_=j_3O1([?Y|:KZ~I`^M??$=k_qe@_&?g~wm.r@cL+X o}10Z{zx?HA44U^');
define('NONCE_SALT', 'qVJ4/C%(?V6*h/h!D-TL=FEUg?^R{:t3uS+T;)CV<5M:ARH<f%la}C-*<HNbY:<y');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wpdb_';

define('WP_ALLOW_MULTISITE', true);

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d'information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */
define( 'SUNRISE', 'on' );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'nuitdebout.dev');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

define('WP_DEFAULT_THEME', 'nuitdeboo-child');

// define('ADMIN_COOKIE_PATH', '/');
// define('COOKIE_DOMAIN', '');
// define('COOKIEPATH', '');
// define('SITECOOKIEPATH', '');

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
```


## Using the multisite

Le DUMP de la database se trouve dans le répertoire /dump à la racine du projet
Le fichier concerné est : **nuitdebout_multisite.sql**


## Default pwd for admin user (temporary)

admin / urWnshZ)f0xYJCbPJ9 (utilise mon mail perso à changer svp)


## Hostname default : nuitdebout.dev

configuré par défaut pour un site en local : **nuitdebout.dev**
(il faut configurer apache2 et le fichier hosts)

Voici l'exemple de vhost que vous pouvez créer, considérant que les fichiers sont stockés dans le répertoire : 

**/Users/duke/Sites/nuitdebout-fr/www**

```
<VirtualHost *:80>
    ServerName nuitdebout.dev

    DocumentRoot "/Users/duke/Sites/nuitdebout-fr/www"

    Options -Indexes
    <Directory /Users/duke/Sites/nuitdebout-fr/www>
        Options Indexes +ExecCGI +SymLinksIfOwnerMatch
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>
    
    ServerAdmin yourEmail@domain.com

    ErrorLog "/Users/duke/Sites/nuitdebout-fr/errors.log"
    CustomLog "/Users/duke/Sites/nuitdebout-fr/access.log" common
</VirtualHost>
```

## Using the child theme named nuitdeboo-child

Vous devez utiliser le thème enfant nommé **nuitdeboo-child**

1. npm install -g gulp bower
2. npm install
3. bower install

Changer l'url de assets/manifest.json (line 25) pour BrowserSync mon vhost étant nuitdebout.dev (Afin que http://localhost:3000 appelle le bon vhost et refresh auto à chaque sauvegarde d'un fichier du thème)

Pour la suite :

1. Au premier lancement ` gulp && gulp watch `

### Available gulp commands

* `gulp` — Compile and optimize the files in your assets directory
* `gulp watch` — Compile assets when file changes are made
* `gulp --production` — Compile assets for production (no source maps).

2. Le reste du temps / les autres fois utilisez la commande 
**gulp watch**

3. Les styles s'éditent bien sur dans assets/styles/

4. Dès lors qu'on a besoin d'une librairie JS il n'y a plus qu'à se servir de la commande bower install
exemple : ` bower install isotope `


