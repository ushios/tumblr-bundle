tumblr-bundle
==========

Create tumblr client using 'config.yml'

---

# Installation

### composer.json

    # composer.json
    
    "require": {
    	"ushios/tumblr-bundle": "0.0.*"
    	...
    }

and run `composer update` command.

### AppKernel.php

    # app/AppKernel.php
    
    public function registerBundles()
    {
        bundles = array(
            // ...
            new Ushios\Bundle\TumblrBundle\UshiosTumblrBundle(),
        );
        
        retrun bundles();
    }


# Configuration

config.yml

    # app/config/config.php
    
    ushios_tumblr:
    client:
        default:
            consumerKey:    ${YOUR_CONSUMER_KEY}
            consumerSecret: ${YOUR_CONSUMER_SECRET}
        named:
            class:          Your\Tumblr|Client # default Tumblr\API\Client
            consumerKey:    ${YOUR_NAMED_CONSUMER_KEY}
            consumerSecret: ${YOUR_NAMED_CONSUMER_SECRET}
            token:          ${YOUR_NAMED_TOKEN} // optional
            tokenSecret:    ${YOUR_NAMED_TOKEN_SECRET} // optional

# Usage

## Get client from service.

Using default settings tumblr client.

    # Bundle/Controller/Controller.php

	public function fooAction()
    {
        $tumblr = $this->container->get('ushios_tumblr_client');
        // or
        $tumblr = $this->container->get('ushios_tumblr_client.default');
    }

Using named settings. 

    # Bundle/Controller/Controller.php

	public function fooAction()
    {
        $aws = $this->container->get('ushios_tumblr_client.named');
        get_class($aws); // Your\Tumblr\Client
    }

## Client

@see [tumblr/tumblr web site](https://github.com/tumblr/tumblr.php)