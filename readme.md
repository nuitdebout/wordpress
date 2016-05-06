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
- Installer [Ansible](http://ansible.com) via les [Instruction d'installation](http://docs.ansible.com/intro_installation.html#installation).

Ensuite il n'y a plus qu'a lancer la machine. Elle devrait installer wordpress et importer les données.
```
    vagrant up
```

- Ajouter la ligne suivante au fichier `/etc/hosts`

```
    192.168.33.10 nuitdebout.dev
```

- Aller sur `http://nuitdebout.dev`.


### Avec Docker

**Attention** : Suite à des modifications récentes, le Docker doit être mis à jour

1. Lancer `./script/bootstrap` et suivez les indications
1. Aller sur [nuitdebout.dev](http://nuitdebout.dev)

Pour relancer plus tard: `./script/server`

## Développement

### Compilation du thème

Le thème est installé dans `./theme`. Il utilise Sass, Gulp, Bower et Composer.

Normalement, il a déjà été compilé à la création de la machine virtuelle. Vous pouvez le refaire manuellement à l'aide des commandes

```
$ cd theme
$ npm install -g gulp bower
$ npm install
$ bower install
$ composer install
```

En cas de problème avec node-sass lancez la commande
```
npm uninstall gulp-sass && npm install gulp-sass --no-progress
```
C'est du au fait que node-sass a compilé des bianire sur la machine virtuelle qui ne sont pas compatible avec votre machine locale.


Les fichiers source se trouvent dans `theme/assets`

Les fichiers compilés se trouvent dans `theme/dist`

Pour recompiler les assets à chaque modification de fichier, lancer la tâche `watch` :

```
$ gulp watch
```

### Ajout d'un plugin

Pour ajouter un plugin, il faut le mettre à la fin de la liste située dans `./ansible/site.yml`.

Pour lancer l'installation, le plus safe est reprovisionner la machine :
```
vagrant provision
```

Si vous aimez vivre dangereusement, vous pouvez lancer
``̀`
vagrant ssh -c "wp plugin install nom_du_plugin --activate-network --activate --path=/var/www"
```
