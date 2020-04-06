<?php

namespace TwbBundleTest\Form\View\Helper;

class TwbBundleFormTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleForm
     */
    protected $formHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp() : void
     */
    public function setUp() : void
    {
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer = new \Laminas\View\Renderer\PhpRenderer();
        $this->formHelper = $oViewHelperPluginManager->get('form')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    public function testInvoke()
    {
        return $this->assertSame($this->formHelper, $this->formHelper->__invoke());
    }

    public function testRenderFormWithClassAlreadyDefined()
    {
        $oForm = new \Laminas\Form\Form(null, array('attributes' => array('class' => 'test-class')));
        $this->formHelper->render($oForm->setAttribute('class', 'test-class'));
        $this->assertEquals('test-class form-horizontal', $oForm->getAttribute('class'));
    }
}
