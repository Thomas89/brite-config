Brite Config
============

A simple PHP configuration class with dot-notation access
---------------------------------------------------------

Somehow I have struggled to find a lightweight class that:

* Is small, simple and unit-tested [![Build Status](http://travis-ci.org/searbe/brite-config.png)](http://travis-ci.org/searbe/brite-config)
* Parses both INI files and PHP arrays
* Deals with inheritance

So I have created that missing class (well, three classes, to be accurate). 

Usage
-----

To parse your .ini configuration file, imagine you have the following contents:

    [default]
    
    database.host = bar
    database.user = foo
    database.pass = baz
    
    service.api_key = 123456
    
    email = test@dev.com
    
    [staging:default]
    
    database.user = foo2
    database.pass = baz2
    
    [production:staging]
    
    database.user = foo1
    database.pass = baz1
    email = test@production.com


Or alternatively, if you prefer plain PHP arrays:
    
    <?php
    
    $config['default']['database']['host'] = 'bar';
    $config['default']['database']['user'] = 'foo';
    $config['default']['database']['pass'] = 'baz';
    
    $config['default']['service']['api_key'] = '123456';
    
    $config['production']['extends'] = 'staging';
    $config['production']['database']['user'] = 'foo1';
    $config['production']['database']['pass'] = 'baz1';
    
    $config['staging']['extends'] = 'default';
    $config['staging']['database']['user'] = 'foo2';
    $config['staging']['database']['pass'] = 'baz2';
    
    $config['default']['email'] = 'test@dev.com';
    $config['production']['email'] = 'test@production.com';


During bootstrap, register your configuration file:

    <?php
    
    \Brite\Config::register('default', __DIR__ . '/test_config/config.php', 'staging');
    

Then access your configuration when required:

    <?php
    
    echo \Brite\Config::instance()->get('database.host');
    \\ output: "bar"
    echo \Brite\Config::instance()->get('database.user');
    \\ output: "foo1"
    

Alternatively, if you have multiple configuration files, you may name your
configuration something other than 'default' during bootstrap, and access it
via:

    <?php
    
    echo \Brite\Config::instance('database')->get('host');


Or if you prefer, you may simple create an instance of a configuration class and
register it with your own registry for global access:

    <?php
    
    $config = new \Brite\IniConfig('/path/to/file.ini', 'section-name');
    
    // Now register $config with your registry


... and that's it. Simple!
