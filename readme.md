# Site portail nuitdebout.fr

Utilise WordPress multisites.

> utilisé pour faire le lien entre les differents outils disponibles (wiki, chat, )
> faire le lien vers les comptes sociaux (FB, twitter, periscope, etc..)
> destiné à pouvoir etre utilisé par chaque ville qui le souhaite (son propre site)
> peut servir de base de redirection pour les villes ayant leur propre site deja en place
> "juste" le theme peut être utilisé par les villes ayant un wordpress mais avec un theme generique

exemple: nuitdebout.fr/marseille (utilisation de répertoire statué sur loomio)

> utilise un "theme" commun qui peut etre largement modifié et adapté avec ses propres liens et contenus

## Utilisation de la machine virtuelle

- Installer [VirtualBox](https://www.virtualbox.org/) & [Vagrant](https://docs.vagrantup.com/v2/installation/index.html)
- Installer Vagrant Omnibus, puis lancer la création de la machine virtuelle
```
$ vagrant plugin install vagrant-omnibus
$ vagrant up
```
- Copier la configuration
```
$ cp wp-config.php.dist wp-config.php
```
- Importer la base de données :
```
$ vagrant ssh -c 'cat /var/www/nuitdebout/dump/nuitdebout_multisite.sql | mysql -h127.0.0.1 -uroot -pleurfairepeur nuitdebout'
```

- Ajouter la ligne suivante au fichier `/etc/hosts`
```
192.168.31.03 nuitdebout.dev
```
- Aller sur `http://nuitdebout.dev`.


Pour arrêter la machine virtuelle, lancer `vagrant halt`.

## Default pwd for admin user (temporary)

admin / urWnshZ)f0xYJCbPJ9 (utilise mon mail perso à changer svp)

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
