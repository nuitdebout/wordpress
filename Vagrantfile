$NFS = ENV.has_key?('VM_NFS') ? ENV['VM_NFS'] != "false" : true

Vagrant.configure("2") do |config|
    # Configure the box to use
    config.vm.box       = 'debian/jessie64'

    # Configure the network interfaces
    config.vm.network :private_network, ip:    "192.168.31.3"
    config.vm.network :forwarded_port,  guest: 80,    host: 8070
    config.vm.network :forwarded_port,  guest: 8081,  host: 8071
    config.vm.network :forwarded_port,  guest: 3306,  host: 3306
    config.vm.network :forwarded_port,  guest: 27017, host: 27017

    # Configure shared folders
    config.vm.synced_folder ".",  "/vagrant", id: "vagrant-root", nfs: $NFS
    config.vm.synced_folder "./wordpress", "/var/www/nuitdebout", id: "application", nfs: $NFS
    config.vm.synced_folder "./theme", "/var/www/nuitdebout/wp-content/themes/nuitdebout",
        id: "theme", nfs: $NFS

    # Configure VirtualBox environment
    config.vm.provider :virtualbox do |v|
        v.name = (0...8).map { (65 + rand(26)).chr }.join
        v.customize [ "modifyvm", :id, "--memory", 512 ]
    end

    # Provision the box
    config.vm.provision :ansible do |ansible|
        ansible.extra_vars = { ansible_ssh_user: 'vagrant' }
        ansible.playbook = "ansible/site.yml"
    end
end
