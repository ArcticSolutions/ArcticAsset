Arctic Solutions Assets Tracker
========================

ArcticAsset is an web application built by [Arctic Solutions](http://arcticsolutions.no/). 
It's main purpose is to assist IT-departments track issues with IT equipment.

The application is build using the [Symfony2](http://symfony.com/) framework. 

1) Installation
---------------

Once you've downloaded the the project, installation is easy, and basically
involves making sure your system is ready for Symfony.

### a) Install the source files

Copy and install the sourcefiles on your server that supports the Symfon2 framework. Make
sure that the webserver points to the ``web/`` directory.

### b) Configure the app

Configure your own ``parameters.ini`` file in ``app/config/``. You can use the 
``parameters.ini.dist`` file as a starting point.

### c) Install the vendors

Run the following command from the root of the installation to make sure all the
needed libraries are installed to make the application run.

    php bin/vendors install

### d) Check your System Configuration

Before you begin using the application, make sure that your local system is properly 
configured for Symfony. To do this, execute the following:

    php app/check.php

If you get any warnings or recommendations, fix these now before moving on.

### e) Access the Application via the Browser

Congratulations! You're now ready to use ArcticAsset. Just point your webbrowser to
the url that you configured you webserver to use.


What's inside?
---------------
The ArcticAsset application comes pre-configured with the following bundles:

* **FrameworkBundle** - The core Symfony framework bundle
* **SensioFrameworkExtraBundle** - Adds several enhancements, including template
  and routing annotation capability ([documentation](http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/index.html))
* **DoctrineBundle** - Adds support for the Doctrine ORM
  ([documentation](http://symfony.com/doc/current/book/doctrine.html))
* **TwigBundle** - Adds support for the Twig templating engine
  ([documentation](http://symfony.com/doc/current/book/templating.html))
* **SecurityBundle** - Adds security by integrating Symfony's security component
  ([documentation](http://symfony.com/doc/current/book/security.html))
* **SwiftmailerBundle** - Adds support for Swiftmailer, a library for sending emails
  ([documentation](http://symfony.com/doc/2.0/cookbook/email.html))
* **MonologBundle** - Adds support for Monolog, a logging library
  ([documentation](http://symfony.com/doc/2.0/cookbook/logging/monolog.html))
* **AsseticBundle** - Adds support for Assetic, an asset processing library
  ([documentation](http://symfony.com/doc/2.0/cookbook/assetic/asset_management.html))
* **JMSSecurityExtraBundle** - Allows security to be added via annotations
  ([documentation](http://symfony.com/doc/current/bundles/JMSSecurityExtraBundle/index.html))
* **WebProfilerBundle** (in dev/test env) - Adds profiling functionality and
  the web debug toolbar
* **SensioDistributionBundle** (in dev/test env) - Adds functionality for configuring
  and working with Symfony distributions
* **SensioGeneratorBundle** (in dev/test env) - Adds code generation capabilities
  ([documentation](http://symfony.com/doc/current/bundles/SensioGeneratorBundle/index.html))

Enjoy!
