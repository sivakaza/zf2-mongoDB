1. git clone the ZF2 Skeleton Application

        git clone git://github.com/zendframework/ZendSkeletonApplication.git

2. cd into the ZendSkeletonApplication directory and open the composer.json in your favourite text editor.

        {

            "name": "zendframework/skeleton-application",

            "description": "Skeleton Application for ZF2",

            "license": "BSD-3-Clause",

            "keywords": [

                "framework",

                "zf2"

            ],

            "homepage": "http://framework.zend.com/",

            "minimum-stability": "dev",

            "require": {

                "php": ">=5.3.3",

                "zendframework/zendframework": "2.*",

                "doctrine/doctrine-mongo-odm-module": "dev-master"

            }

        }

3. Update your composer.json and run

        php composer.phar self-update

        php composer.phar install

4. If you are success with installing all dependencies using composer follow the official guide here to set up virtual-host and update hosts file.

5. If you are unable to update those dependencies and found something similar to this,

Check your composer.json for any mistakes, or follow my previous blog post.

6. Add the doctrine modules to your config file, config/application.config.php. Update the modules array similar to this, here im adding zend module named course as well.

                'modules' => array(

                    'Application',

                    'Course',

                    'DoctrineModule',

                    'DoctrineMongoODMModule',

                ),

7.  Copy the doctrine-odm config file to your config directory, and update according to your environment.This is where you set your server hosts, ports, username, and passwords etc.

        cp vendor/doctrine/doctrine-mongo-odm-module/config/module.doctrine-mongo-odm.local.php.dist config/module.doctrine-mongo-odm.local.php 

 and update,

8. You can try the course module I have created here with course add and retrieve course data.
