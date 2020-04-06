<?php
namespace TwbBundleTest\View\Helper;
class TwbBundleLabelTest extends \PHPUnit\Framework\TestCase{
	/**
	 * @var \TwbBundle\View\Helper\TwbBundleLabel
	 */
	protected $labelHelper;

	/**
	 * @see \PHPUnit\Framework\TestCase::setUp() : void
	 */
	public function setUp() : void{
		$oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
		$oRenderer = new \Laminas\View\Renderer\PhpRenderer();
		$this->labelHelper = $oViewHelperPluginManager->get('label')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithWrongTypeAttributes(){
		$this->labelHelper->render('test',new \stdClass());
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithEmptyClassAttributes(){
		$this->labelHelper->render('test',array('class' => ''));
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testRenderWithWrongTypeClassAttributes(){
		$this->labelHelper->render('test',array('class' => new \stdClass()));
	}
}
