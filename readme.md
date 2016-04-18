# Site portail nuitdebout.fr

Utilise WordPress multisites.

> utilisé pour faire le lien entre les differents outils disponibles (wiki, chat, )
> faire le lien vers les comptes sociaux (FB, twitter, periscope, etc..)
> destiné à pouvoir etre utilisé par chaque ville qui le souhaite (son propre site)
> peut servir de base de redirection pour les villes ayant leur propre site deja en place
> "juste" le theme peut être utilisé par les villes ayant un wordpress mais avec un theme generique

exemple: nuitdebout.fr/marseille (utilisation de répertoire statué sur loomio)

> utilise un "theme" commun qui peut etre largement modifié et adapté avec ses propres liens et contenus

## Utilisation de la configuration par défaut

Pour installer la configuration par défaut, copiez le fichier ̀̀`wp-config.php.dist` vers `wp-config.php` :
```bash
cp wp-config.php.dist wp-config.php
```

## Utiliser le multisite

Nous partons du principe que votre database se nomme : **nuitdebout2**
Le DUMP de la database se trouve dans le répertoire /dump à la racine du projet
Le fichier concerné est : **nuitdebout_multisite.sql**

Pour mettre à jour votre base de donnée avec mysql :
```bash
mysql -u root -D nuitdebout2 -p < dump/nuitdebout_multisite.sql
```

## Default pwd for admin user (temporary)

admin / urWnshZ)f0xYJCbPJ9 (utilise mon mail perso à changer svp)


## Hostname default : nuitdebout.dev

configuré par défaut pour un site en local : **nuitdebout.dev**
(il faut configurer apache2 et le fichier hosts)

Voici l'exemple de vhost que vous pouvez créer, considérant que les fichiers sont stockés dans le répertoire :

**/Users/YOUR_USER/Sites/nuitdebout-fr/www**

```
<VirtualHost *:80>
    ServerName nuitdebout.dev

    DocumentRoot "/Users/YOUR_USER/Sites/nuitdebout-fr/www"

    Options -Indexes
    <Directory /Users/YOUR_USER/Sites/nuitdebout-fr/www>
        Options Indexes +ExecCGI +SymLinksIfOwnerMatch
        AllowOverride All
        Order allow,deny
        Allow from all
    </Directory>

    ServerAdmin yourEmail@domain.com

    ErrorLog "/Users/YOUR_USER/Sites/nuitdebout-fr/errors.log"
    CustomLog "/Users/YOUR_USER/Sites/nuitdebout-fr/access.log" common
</VirtualHost>
```

## Using the child theme named nuitdeboo-child

Placez vous dans le répertoire (comme prédéfinit ci dessus) :
**wp-content/themes/nuitdeboo-child**

Vous devez utiliser le thème enfant nommé **nuitdeboo-child** puis au sein de ce répertoire lancer les commandes suivantes :

1. `npm install -g gulp bower`
2. `npm install`
3. `bower install`

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
exemple : ` bower install --save isotope `
