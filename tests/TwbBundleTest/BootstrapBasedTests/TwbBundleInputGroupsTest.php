<?php

namespace TwbBundleTest;

/**
 * Test input groups rendering
 * Based on http://getbootstrap.com/components/#input-groups
 */
class TwbBundleInputGroupsTest extends \PHPUnit\Framework\TestCase {

    /**
     * @var string
     */
    protected $expectedPath;

    /**
     * @var \TwbBundle\Form\View\Helper\TwbBundleFormElement
     */
    protected $formElementHelper;

    /**
     * @see \PHPUnit\Framework\TestCase::setUp() : void
     */
    public function setUp() : void {
        $this->expectedPath = __DIR__ . DIRECTORY_SEPARATOR . '../../_files/expected-input-groups' . DIRECTORY_SEPARATOR;
        $oViewHelperPluginManager = \TwbBundleTest\Bootstrap::getServiceManager()->get('ViewHelperManager');
        $oRenderer = new \Laminas\View\Renderer\PhpRenderer();
        $this->formElementHelper = $oViewHelperPluginManager->get('formElement')->setView($oRenderer->setHelperPluginManager($oViewHelperPluginManager));
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-basic
     */
    public function testBasicExample() {
        $sContent = '';

        $oInput = new \Laminas\Form\Element\Text('input-prepend', array('add-on-prepend' => '@'));
        $oInput->setAttribute('placeholder', 'Username');
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        $oInput = new \Laminas\Form\Element\Text('input-append', array('add-on-append' => '.00'));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        $oInput = new \Laminas\Form\Element\Text('input-append-prepend', array('add-on-prepend' => '$', 'add-on-append' => '.00'));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-basic.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-sizing
     */
    public function testSizing() {
        $sContent = '';

        //Large
        $oInput = new \Laminas\Form\Element\Text('input-prepend', array('add-on-prepend' => '@'));
        $oInput->setAttributes(array('placeholder' => 'Username', 'class' => 'input-lg'));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Default
        $oInput = new \Laminas\Form\Element\Text('input-prepend', array('add-on-prepend' => '@'));
        $oInput->setAttribute('placeholder', 'Username');
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Small
        $oInput = new \Laminas\Form\Element\Text('input-prepend', array('add-on-prepend' => '@'));
        $oInput->setAttributes(array('placeholder' => 'Username', 'class' => 'input-sm'));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-sizing.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-checkboxes-radios
     */
    public function testCheckboxesAndRadioAddons() {
        $sContent = '';

        //Checkbox
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-prepend' => new \Laminas\Form\Element\Checkbox('checkbox')));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Radio
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-prepend' => new \Laminas\Form\Element\Radio('radio', array('value_options' => array(1 => '')))));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-checkboxes-radios.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons
     */
    public function testButtonAddons() {
        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', array('label' => 'Go!'))));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-append' => new \Laminas\Form\Element\Button('append-button', array('label' => 'Go!'))));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-buttons.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons-dropdowns
     */
    public function testButtonsWithDropdowns() {
        $aButtonOptions = array('label' => 'Action', 'dropdown' => array(
                'label' => 'Dropdown',
                'name' => 'dropdownMenu1',
                'attributes' => array('class' => 'clearfix'),
                'list_attributes' => array('aria-labelledby' => 'dropdownMenu1'),
                'items' => array('Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link')
        ));

        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', $aButtonOptions)));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-append' => new \Laminas\Form\Element\Button('append-button', $aButtonOptions)));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-buttons-dropdowns.phtml', $sContent);
    }

    /**
     * Test http://getbootstrap.com/components/#input-groups-buttons-segmented
     */
    public function testSegmentedButtons() {
        $aButtonOptions = array('label' => 'Action', 'dropdown' => array(
                'label' => 'Dropdown',
                'name' => 'dropdownMenu1',
                'split' => true,
                'attributes' => array('class' => 'clearfix'),
                'list_attributes' => array('aria-labelledby' => 'dropdownMenu1'),
                'items' => array('Action', 'Another action', 'Something else here', \TwbBundle\View\Helper\TwbBundleDropDown::TYPE_ITEM_DIVIDER, 'Separated link')
        ));

        $sContent = '';

        //Prepend
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-prepend' => new \Laminas\Form\Element\Button('prepend-button', $aButtonOptions)));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Append
        $oInput = new \Laminas\Form\Element\Text('input-username', array('add-on-append' => new \Laminas\Form\Element\Button('append-button', $aButtonOptions)));
        $sContent .= $this->formElementHelper->__invoke($oInput) . "\n";

        //Test content
        $this->assertStringEqualsFile($this->expectedPath . 'input-groups-buttons-segmented.phtml', $sContent);
    }
}
