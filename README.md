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

Then install the bundle with the command:

    php composer update

Enable the bundle in your application kernel:

    <?php
    // app/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
            // ...
            new IDCI\Bundle\GenealogyBundle\IDCIGenealogyBundle(),
        );
    }

Now the Bundle is installed.

