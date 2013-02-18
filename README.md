# SLIMful
***

SLIMful is a JSON REST API build with the use of [Slim Framework](http://www.slimframework.com) and [Doctrine](http://www.doctrine-project.org). 

## Installation

### Git clone
To get the latest source you can use git clone.

    $ git clone https://github.com/jeroenweustink/SLIMful.git /path/to/slimful

### Composer
Installation can be done with the use of composer. If you don't have composer yet you can install it by doing:

    $ curl -s https://getcomposer.org/installer | php
    
To install it globaly 
    
    $ sudo mv composer.phar /usr/local/bin/composer
    
### Vendor

    $ cd /path/to/slimful
    $ composer update
    $ composer install
    
### Database credentials

    $ cp /path/to/slimful/config/local.ini/dist /path/to/slimful/config/local.ini

Edit the credentials in the local.ini file

   [database]
   driv = 'pdo_mysql'
   host = 'localhost'
   port = '3306'
   user = ''
   pass = ''
   name = ''
    
### Create schema

    $ /path/to/slimful/vendor/bin/doctrine orm:schema-tool:create
    
### Update schema

    $ /path/to/slimful/vendor/bin/doctrine orm:schema-tool:update --force
    
## Entities

To find out how Doctrine entities work, see [Object Relation Mapper](http://www.doctrine-project.org/projects/orm.html). The entities can be found in:

    $ cd /path/to/slimful/app/entity/

## Example

A user resource has been created for testing purposes. These are some cURL commands you can use

    // Create a user
    $ curl -i -X POST -d "email=test@test.com&password=foo" http://yourapi.com/user

    // Get a user
    $ curl -i -X GET http://yourapi.com/user/1

    // Get all users
    $ curl -i -X GET http://yourapi.com/user

    // Update a user
    $ curl -i -X PUT -d "email=foo@tbar.com&password=bar" http://yourapi.com/user

    // Delete a user
    $ curl -i -X DELETE  http://yourapi.com/user/1