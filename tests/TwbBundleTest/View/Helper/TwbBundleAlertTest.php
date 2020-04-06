<?php
namespace TwbBundleTest\View\Helper;
class TwbBundleAlertTest extends \PHPUnit\Framework\TestCase{
	/**
	 * @var \TwbBundle\View\Helper\TwbBundleAlert
	 */
	protected $alertHelper;

	/**
	 * @see \PHPUnit\Framework\TestCase::setUp() : void
	 */
	public function setUp() : void{
		$oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
		$oRenderer = new \Laminas\View\Renderer\PhpRenderer();
		$this->alertHelper = $oViewHelperPluginManager->get('alert')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithWrongTypeAttributes(){
		$this->alertHelper->render('test',new \stdClass());
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithEmptyClassAttributes(){
		$this->alertHelper->render('test',array('class' => ''));
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithWrongTypeClassAttributes(){
		$this->alertHelper->render('test',array('class' => new \stdClass()));
	}
}
