Getting started
===============

## Installation

Installation is quick:

1. Download the bundle with composer
2. Enable the Bundle in the Kernel
3. Create your Element class
4. Configure the Bundle
5. Import routes
6. Update your database schema

### 1. Download the bundle with composer

Add the dependencie to your `composer.json` file:

```json
"require": {
    ...
    "idci/genealogy-bundle": "dev-master"
},
```

Download the bundle by running the command:

``` bash
$ php composer.phar update idci/genealogy-bundle
```

### 2. Enable the Bundle in the Kernel

Enable the bundles in your application kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new IDCI\Bundle\GenealogyBundle\IDCIGenealogyBundle(),
        new IDCI\Bundle\ExporterBundle\IDCIExporterBundle(),
    );
}

### 3. Create your Element class

This bundle will store some Element class to a database using the doctrine ORM.
So you first have to to create the Element class for your application.
You can add as many attributes and methods as you want.

To maje it easy, a base clase is already available. It contains what's required for a genealogy to works properly (such as a mother, a father, a sex, etc).

Here is how to create your Element class:

1. Extend the base Element class : Your Element class should live in the Entity namespace of your bundle.
2. Map the id field. It must be protected as it is inherited from the parent class.

##### Annotations

``` php
<?php
// src/Acme/MyGenealogyBundle/Entity/Element.php

namespace Acme\MyGenealogyBundle\Entity;

use IDCI\Bundle\GenealogyBundle\Entity\Element as BaseElement;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="element")
 */
class MyElement extends BaseElement
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
}
```

### Step 4: Configure the Bundle

Add the following configuration to your `config.yml` file.

First import the bundle config file:
```yml
imports:
    ...
    - { resource: @IDCIGenealogyBundle/Resources/config/config.yml }
```

Then specify the location of you element class:
```yml
idci_genealogy:
    element_class: %element_class%
```

And then in your `parameters.yml` file:
```yml
element_class: "Acme\MyGenealogyBundle\Entity\MyElement"
```

### 5. Import routes

Once the activation and configuratino of the bundle done, you have to import the Bundle routing files.

```yml
idci_genealogy:
    resource: "../../vendor/idci/genealogy-bundle/IDCI/Bundle/GenealogyBundle/Controller/"
    type:     annotation

idci_exporter:
    resource: "@IDCIExporterBundle/Controller/"
    type:     annotation
```

### 6. Update your database schema

Now that the bundle is configured, the last thing you need to do is update your
database schema because you have added a new entity, the `MyElement` class.

Just run:

```bash
php app/console doctrine:schema:update --force
```