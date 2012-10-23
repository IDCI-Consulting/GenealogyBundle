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

Now the Bundle is installed and ready to use. You will find new routes by running this command:

    php app/console router debug

    idci_genealogy_query_entity         ANY    /entity/{id}.{_format}
    idci_genealogy_query_entities       ANY    /entities.{_format}
    idci_genealogy_query_childrenentity ANY    /entity/{id}/children.{_format}/{level}
    idci_genealogy_query_parentsentity  ANY    /entity/{id}/parents.{_format}/{level}

{_format} is either xml, or json. The {level} refers to the number of generations you want to retrieve.
    
Furthermore, you can add 3 parameters to your urls, such as birthdate, sex and function. Here is some examples:
    
        http://your_local_path_project/app_dev.php/entities.xml?birthdate=1989-12-23
        http://your_local_path_project/app_dev.php/entities.xml?sex=m  (values are m for males, whatever you want for females)
        http://your_local_path_project/app_dev.php/entities.xml?function=[reproducer]

Quick start
===========

If you installed the DoctrineFixturesBundle, you can test some of theses routes.
First, load the set of data into your database:

    php app/console doctrine:fixtures:load

Each time you run this command, database is purged. You can add the --append parameter to avoid it.

Then, go to http://your_local_path_project/app_dev.php/entities.xml
You should be able to get a xml page, with all elements.
