ERS (Event Registration System)
=============================

Introduction
------------

The Event Registration System has these main tasks:
1. Give the event core orga team the ability to configure all needed tickets easily. (Admin)
1. Give jugglers the possibility to buy tickets for the European Juggling Convention. (PreReg)
2. Give the organisation team onsite the possibility to easily check what the participants have booked. (OnsiteReg)
3. Create needed statistics after the event. (Stats)

Installation instructions
-------------------------

### 1. Get a copy of the project:

```
$ git clone https://github.com/inbaz/ers
```

### 2. Create a VirtualHost running PHP 

We tested on PHP 5.5, maybe 5.4 is working aswell, 5.3 doesn't

PHP modules needed:
- gd
- fileinfo
- iconv
- intl

### 3. Create a mysql database and user

```
mysql> CREATE DATABASE ers CHARACTER SET utf8 COLLATE utf8_bin;
mysql> GRANT ALL PRIVILEGES ON ers.* TO 'ers'@'localhost' IDENTIFIED BY 'CHANGE_ME';
mysql> exit;
```

### 4. Get composer and install dependencies

```
$ curl -sS https://getcomposer.org/installer | php
$ php composer.phar install
```    

### 5. Setup doctrine

Put this into config/autoload/doctrine.local.php. You can find an example in
config/autoload/doctrine.dist.php

```
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' =>'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'localhost',
                    'port'     => '3306',
                    'user'     => 'user',
                    'password' => 'password',
                    'dbname'   => 'database',
                )
            )
        )
    )
);
```

### 6. Setup ERS variables
Put this into config/autoload/ers.local.php. You can find an example in
config/autoload/ers.dist.php

```
return array(
    'ERS' => array(
        'sender_email'      => 'prereg@eja.net',
        'name_short'        => "EJC2016",
        'name_with_year'    => "EJC 2016",
        'name_with_number'  => "39th European Juggling Convention",
        'info_mail'         => "info@ejc2016.org",
        'website'           => "http://www.ejc2016.org",
        'year'              => 2016,
        'start'             => new DateTime('2016-07-30'),
        'end'               => new DateTime('2016-08-07'),
        'registration_info' => 'http://prereg.eja.net',
    ),
    'environment' => 'develop',
    #'environment' => 'testing',
    #'environment' => 'production',
);
```

### 7. Generate database scheme and load basic data

You should run this commands with the users who is running your webserver. 
Either login with that user or prepend to commands with i.e. "sudo -u http" or 
"sudo -u apache".

```
$ php bin/doctrine-module orm:validate-schema
$ php bin/doctrine-module orm:schema-tool:create
$ php bin/doctrine-module orm:schema-tool:update --force
$ php bin/doctrine-module dbal:import data/initial.sql
```

### 8. Add admin user

```
INSERT INTO `user` (`email`, `active`) VALUES ('your.mail@example.org', '1');
```

Check which ids have the roles "user" and "admin".

```
INSERT INTO `user_has_role` (`user_id`, `role_id`) VALUES ('1', '4');
INSERT INTO `user_has_role` (`user_id`, `role_id`) VALUES ('1', '5');
```

### 9. Set admin users password

Goto http://yourdomain.org/profile/request-password, fill in your e-mail 
address and request the mail in which you can find further instructions how to
setup the password for your user.

### 10. Login and go on with the basic setup

Go to Shop menu item and create basic information from top to bottom. After that
add your first products through the Product menu item.

Server Administration Information
---------------------------------

### 1. Firewall

    iptables-save
```
# Generated by iptables-save v1.4.7 on Wed Jan 21 09:57:17 2015
*filter
:INPUT ACCEPT [0:0]
:FORWARD ACCEPT [0:0]
:OUTPUT ACCEPT [8190:1147926]
-A INPUT -m state --state RELATED,ESTABLISHED -j ACCEPT
-A INPUT -p icmp -j ACCEPT
-A INPUT -i lo -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 20 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 21 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 22 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 65495:65535 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 80 -j ACCEPT
-A INPUT -p tcp -m state --state NEW -m tcp --dport 443 -j ACCEPT
-A INPUT -j REJECT --reject-with icmp-host-prohibited
-A FORWARD -j REJECT --reject-with icmp-host-prohibited
COMMIT
# Completed on Wed Jan 21 09:57:17 2015
```

### 2. Webserver

### 3. MySQL server

```
query_cache_size    = 8M
tmp_table_size      = 16M
max_heap_table_size = 16M
thread_cache_size   = 4
table_open_cache    = 64
```