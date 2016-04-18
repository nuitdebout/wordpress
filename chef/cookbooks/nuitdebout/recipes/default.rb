#
# Cookbook Name:: nuitdebout
# Recipe:: default
#
# Copyright 2016, YOUR_COMPANY_NAME
#
# All rights reserved - Do Not Redistribute
#

package "unzip" do
  action :install
end

include_recipe "git::default"

mysql_service 'default' do
  version '5.5'
  initial_root_password 'leurfairepeur'
  action [:create, :start]
end

mysql_client 'default' do
  action :create
end

# Create database

mysql_params = {
  :host     => '127.0.0.1',
  :username => 'root',
  :password => 'leurfairepeur'
}

mysql2_chef_gem 'default' do
  action :install
end

mysql_database 'nuitdebout' do
  connection(
    :host     => '127.0.0.1',
    :username => 'root',
    :password => 'leurfairepeur'
  )
  action :create
end

# Install Apache & PHP

include_recipe "apache2"
include_recipe "php"
include_recipe "apache2::mod_php5"
include_recipe "apache2::mod_expires"

package "php5-mysql" do
  action :install
end

package "php5-mcrypt" do
  action :install
end

package "php5-gd" do
  action :install
end

package "php5-curl" do
  action :install
end

# Create vhost

apache_site "default" do
  enable true
end

web_app 'nuitdebout' do
  template 'vhost.conf.erb'
  docroot '/var/www/nuitdebout'
  server_name 'nuitdebout.dev'
end
