GenealogyBundle
===============

A Genealogy Bundle for Symfony2

Installation
============

To install this bundle please follow the next steps:

First add the dependencie to your `composer.json` file:

    "require": {
        ...
        "idci/genealogy-bundle": "dev-master"
    },

If you wish to use the doctrine-fixtures-bundle (In the purpose of test, datas are already ready to use), add this one:

    "require": {
        ...
        "idci/genealogy-bundle": "dev-master"
    },

And install the bundle(s) with the command:

    php composer update

Secondly, enable the bundle(s) in your application kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new IDCI\Bundle\GenealogyBundle\IDCIGenealogyBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),
        );
    }

You will find documentation about what fixtures are, and how to use them at http://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html

In your routing.yml file, add the following:

    idci_genealogy:
        resource: "@GenealogyBundle/Controller/"
        type:     annotation

Then, if you do not have it yet, you have to configure the database.

Edit your parameters.yml file. Here is an exemple which might help you:

    parameters:
        database_driver:   pdo_mysql
        database_host:     localhost
        database_port:     ~
        database_name:     sf_genealogy
        database_user:     root
        database_password: MyPassword

        mailer_transport:  smtp
        mailer_host:       localhost
        mailer_user:       ~
        mailer_password:   ~

        locale:            en
        secret:            ThisTokenIsNotSoSecretChangeIt

Run theses commands in your workspace directory:

    php app/console doctrine:database:create
    php app/console doctrine:schema:create

Else, just run the following:

    php app/console doctrine:schema:update

Now the Bundle is installed and ready to use.

Quick start
===========

If everything runs smoothly, you will find new routes by running this command:

    php app/console router debug

If you installed the DoctrineFixturesBundle, you can test some of theses routes.
First, load the set of data into your database:

    php app/console doctrine:fixtures:load

Each time you run this command, database is purged. You can add the --append parameter to avoid it.

For instance, go to http://your_local_path_project/app_dev.php/entities.xml. 
Eventually, you should be able to get a xml page, with all elements.