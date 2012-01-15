<?php

require_once 'autoload.php';

use brite\config\PhpConfig,
    brite\config\ArrayConfig,
    brite\config\Config;

class ConfigTest extends PHPUnit_Framework_TestCase {
    public function testParsePhp() {
        Config::unregister();
        $config = Config::register('php', __DIR__ . '/test_config/config.php', 'production');
        $this->assertInstanceOf('\brite\config\PhpConfig', $config);
    }
    
    public function testParseIni() {
        Config::unregister();
        $config = Config::register('ini', __DIR__ . '/test_config/config.ini', 'production');
        $this->assertInstanceOf('\brite\config\IniConfig', $config);
    }
    
    public function testMultipleInstances() {
        Config::unregister();
        $phpa = Config::register('php', __DIR__ . '/test_config/config.php', 'production');
        $inia = Config::register('ini', __DIR__ . '/test_config/config.ini', 'staging');
        
        $phpb = Config::instance('php');
        $inib = Config::instance('ini');
        
        $this->assertInstanceOf('\brite\config\PhpConfig', $phpb);
        $this->assertSame($phpa, $phpb);
        
        $this->assertInstanceOf('\brite\config\IniConfig', $inib);
        $this->assertSame($inia, $inib);
    }
    
    public function testDefaultInstance() {
        Config::unregister();
        $phpa = Config::register('default', __DIR__ . '/test_config/config.php', 'production');
        
        Config::register('php', __DIR__ . '/test_config/config.php', 'production');
        Config::register('ini', __DIR__ . '/test_config/config.ini', 'production');
        
        $phpb = Config::instance();
        
        $this->assertSame($phpa, $phpb);
    }
}
