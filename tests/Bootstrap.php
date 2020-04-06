<?php

namespace TwbBundleTest;

use Laminas\ServiceManager\ServiceManager;
use Laminas\Mvc\Service;

include '../vendor/autoload.php';

error_reporting(E_ALL | E_STRICT);
chdir(__DIR__);

class Bootstrap {

    /**
     * @var \Laminas\ServiceManager\ServiceManager
     */
    protected static $serviceManager;

    /**
     * @var array
     */
    protected static $config;

    /**
     * Initialize bootstrap
     */
    public static function init() {
        //Load the user-defined test configuration file, if it exists;
        $aTestConfig = include is_readable(__DIR__ . '/TestConfig.php') ? __DIR__ . '/TestConfig.php' : __DIR__ . '/TestConfig.php.dist';
        $aZf2ModulePaths = array();
        if (isset($aTestConfig['module_listener_options']['module_paths'])) {
            foreach ($aTestConfig['module_listener_options']['module_paths'] as $sModulePath) {
                if (($sPath = static::findParentPath($sModulePath))) {
                    $aZf2ModulePaths[] = $sPath;
                }
            }
        }

        // Use ModuleManager to load this module and it's dependencies
        static::$config = \Laminas\Stdlib\ArrayUtils::merge(array(
                    'module_listener_options' => array(
                        'module_paths' => array_merge(
                                $aZf2ModulePaths, explode(PATH_SEPARATOR, (getenv('ZF2_MODULES_TEST_PATHS')? : (defined('ZF2_MODULES_TEST_PATHS') ? ZF2_MODULES_TEST_PATHS : '')))
                        )
                    )
                        ), $aTestConfig);

        $configuration = static::$config;
        // Prepare the service manager
        $smConfig = isset($configuration['service_manager']) ? $configuration['service_manager'] : array();
        $smConfig = new Service\ServiceManagerConfig($smConfig);

        $serviceManager = new ServiceManager();
        $smConfig->configureServiceManager($serviceManager);
        $serviceManager->setService('ApplicationConfig', $configuration);

        // Load modules
        $serviceManager->get('ModuleManager')->loadModules();

        static::$serviceManager = $serviceManager;
    }

    /**
     * @return \Laminas\ServiceManager\ServiceManager
     */
    public static function getServiceManager() {
        return static::$serviceManager;
    }

    /**
     * @return array
     */
    public static function getConfig() {
        return static::$config;
    }

    /**
     * Retrieve parent for a given path
     * @param string $sPath
     * @return boolean|string
     */
    protected static function findParentPath($sPath) {
        $sCurrentDir = __DIR__;
        $sPreviousDir = '.';
        while (!is_dir($sPreviousDir . '/' . $sPath)) {
            $sCurrentDir = dirname($sCurrentDir);
            if ($sPreviousDir === $sCurrentDir) {
                return false;
            }
            $sPreviousDir = $sCurrentDir;
        }
        return $sCurrentDir . '/' . $sPath;
    }

}

Bootstrap::init();
