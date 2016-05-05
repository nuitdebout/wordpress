# Vagrant environment for Wordpress

This project provides a virtual environment for Wordpress development using
[Vagrant](https://www.vagrantup.com).

## What's in the box?

When you start Vagrant, this environment will provide the following tools
that can be useful when developing for Wordpress:

- Git
- cURL
- MySQL
  * Username: `root`
  * Password: empty
- nginx
- PHP
- PHP-FPM
- PEAR
- node
- gulp

Additionally, it will create a MySQL database called `wordpress`.

## Usage and requirements

### Ansible

[Ansible](http://ansible.com) is used to provision the virtual machine, so you
must have that installed. Follow the
[installation instructions](http://docs.ansible.com/intro_installation.html#installation).

### Usage

Installation is as easy as cloning a GitHub project:

```
$ cd your-symfony-project
$ git clone https://github.com/kleiram/vagrant-symfony.git
```

Vagrant will search the project code in the `../wordpress` directory.

After the project is added, you can start the environment like this:

```
$ vagrant up
```

Starting the VM might take some time, since it will download the entire box
and additional applications/library. When the VM is done setting up, point
your browser towards [http://192.168.33.10](http://192.168.33.10) and there you
have it.

#### Note

If you're using Windows, you have to modify the `Vagrantfile` a little bit to
make it all work (since Windows doesn't support NFS). Replace the following
lines in the Vagrantfile:

```ruby
config.vm.synced_folder ".",  "/vagrant", id: "vagrant-root", :nfs => true
config.vm.synced_folder "./wordpress", "/var/www", id: "application",  :nfs => true
```

with:

```ruby
config.vm.synced_folder ".",  "/vagrant", id: "vagrant-root"
config.vm.synced_folder "./wordpress", "/var/www", id: "application"
