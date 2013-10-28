GenealogyBundle
===============

The Genealogy Bundle aim to install a horse genealogy api.

## Prerequisites

This bundle requires Symfony 2.3 or more.

# Installation

To install this bundle please follow the next steps:

First add the dependency in your `composer.json` file:

```json
"require": {
    ...
    "idci/genealogy-bundle": "dev-master"
},
```

Then install the bundle with the command:

```sh
php composer update
```

Enable the bundles in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IDCI\Bundle\GenealogyBundle\IDCIGenealogyBundle(),
        new IDCI\Bundle\ExporterBundle\IDCIExporterBundle()
    );
}
```

Update your routing.yml file:

```yml
idci_genealogy:
    resource: "@IDCIGenealogyBundle/Controller/"
    type:     annotation

idci_exporter:
    resource: "@IDCIExporterBundle/Controller/"
    type:     annotation
```yml

Finally add the bundle config in your `config.yml` file:

```yml
imports:
    ...
    - { resource: @IDCIGenealogyBundle/Resources/config/config.yml }
```

Now the Bundle is installed.

# Loading data

Some fixtures are ready to be loaded in database.

To load them, run the command

```sh
php app/console doctrine:fixtures:load
```