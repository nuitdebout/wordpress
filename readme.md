```
 _   _         _  _    ______       _                    _
| \ | |       (_)| |   |  _  \     | |                  | |
|  \| | _   _  _ | |_  | | | | ___ | |__    ___   _   _ | |_
| . ` || | | || || __| | | | |/ _ \| '_ \  / _ \ | | | || __|
| |\  || |_| || || |_  | |/ /|  __/| |_) || (_) || |_| || |_
\_| \_/ \__,_||_| \__| |___/  \___||_.__/  \___/  \__,_| \__|
```

Ce dépôt contient le code source du site [nuitdebout.fr](nuitdebout.fr), propulsé par Wordpress.

## Contribuer

La plupart de choses à faire sur le site sont listées dans l'onglet [Issues](https://github.com/nuitdebout/wordpress/issues), nous nous efforçons de le tenir à jour.

Vous pouvez en rajouter si vous remarquez un bug, ou si vous avez une suggestion.
Vous pouvez bien entendu soumettre directement une Pull Request

Afin de simplifier l'usage des Issues, nous nous appuyons sur [ZenHub](https://www.zenhub.io/), une extension Chrome/Firefox qui ajoute des fonctionnalités à l'interface de Github, dont notamment un Kanban.

Description rapide du workflow :

- Les tâches dans la liste **Backlog** sont en cours de discussion
- Les tâches dans la liste **Todo** sont prêtes à être traitées
- Si vous commencez une tâche, **assignez-vous la tâche**, et déplacez-la dans la liste **In Progress**
- Lorsque vous estimez que la tâche est terminée, créez une Pull Request : une fois la Pull Request validée, la tâche est déplacée dans la liste **Done**

Si vous ne disposez pas des droits nécessaire pour déplacer les issues, mentionnez simplement l'un des développeurs, ou venez sur le [chat](https://chat.nuitdebout.fr/channel/dev-nuitdebout.fr).

## Environnement de développement

Le projet est fourni avec une machine virtuelle afin de pouvoir faire tourner le site sur sa machine.

### Compte administrateur

Identifiant ou adresse de messagerie : **admin**
Mot de passe : **urWnshZ)f0xYJCbPJ9**

### Avec Vagrant

- Installer [VirtualBox](https://www.virtualbox.org/) & [Vagrant](https://docs.vagrantup.com/v2/installation/index.html)
- Installer Vagrant Omnibus et hosts, puis lancer la création de la machine virtuelle
```
$ vagrant plugin install vagrant-omnibus
$ vagrant plugin install vagrant-hosts
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
192.168.31.3 nuitdebout.dev
```
- Aller sur `http://nuitdebout.dev`.


Pour arrêter la machine virtuelle, lancer `vagrant halt`.

### Avec Docker

1. Lancer `./script/bootstrap` et suivez les indications
1. Aller sur [nuitdebout.dev](http://nuitdebout.dev)

Pour relancer plus tard: `./script/server`

## Compilation du thème

Le thème utilise Sass, Gulp, Bower et Composer.

```
$ cd wp-content/themes/nuitdeboo-child
$ npm install -g gulp bower
$ npm install
$ bower install
$ composer install
```

Les fichiers source se trouvent dans `wp-content/themes/nuitdeboo-child/assets`

Les fichiers compilés se trouvent dans `wp-content/themes/nuitdeboo-child/dist`

Pour recompiler les assets à chaque modification de fichier, lancer la tâche `watch` :

```
$ gulp watch
```
