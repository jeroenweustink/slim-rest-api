# SLIMful
***

SLIMful is a JSON REST API build with the use of [Slim Framework](http://www.slimframework.com) and [Doctrine](http://www.doctrine-project.org). 

## Installation 
***

### Composer
Installation can be done with the use of composer. If you don't have composer yet you can install it by doing:

    curl -s https://getcomposer.org/installer | php
    
To install it globaly 
    
    sudo mv composer.phar /usr/local/bin/composer
    
### Vendor

    $ cd /path/to/slimful
    $ composer update
    $ composer install
    
### Database credentials

    $ cp /path/to/slimful/config/local.ini/dist /path/to/slimful/config/local.ini
    
### Create schema

    $ /path/to/slimful/vendor/bin/doctrine orm:schema-tool:create
    
### Update schema

    $ /path/to/slimful/vendor/bin/doctrine orm:schema-tool:update --force
    
## Entities
***

To find out how Doctrine entities work you can read about [Object Relation Mapper](http://www.doctrine-project.org/projects/orm.html). The entities can be found in:

    $ cd /path/to/slimful/app/entity/
    
There is a simple user entity that can be used for testing purposes.

## Documentation
***

Will follow soon.
