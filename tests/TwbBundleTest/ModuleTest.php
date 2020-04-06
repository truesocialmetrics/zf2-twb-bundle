<?php
namespace TwbBundleTest;
class ModuleTest extends \PHPUnit\Framework\TestCase{

	/**
	 * @var \TwbBundle\Module
	 */
	protected $module;

	public function setUp() : void{
		$this->module = new \TwbBundle\Module();
	}

	public function testGetAutoloaderConfig(){
		$this->assertEquals(
			array('Laminas\Loader\ClassMapAutoloader' => array(realpath(getcwd().'/../autoload_classmap.php'))),
			$this->module->getAutoloaderConfig()
		);
	}

	public function testGetConfig(){
		$this->assertTrue(is_array($this->module->getConfig()));
	}
}
