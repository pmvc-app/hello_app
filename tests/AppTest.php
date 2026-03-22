<?php
namespace PMVC\App\hello_app;

use PMVC\TestCase;

class HelloAppTest extends TestCase
{
    private $_app;
/**
    should not defined __construct will make
    phpunit array_merge error 
    function __construct() { }
*/

    function pmvc_setup()
    {
        $dirs = explode('/',__DIR__);
        $app = $dirs[count($dirs)-2];
        $this->_app = $app;
        \PMVC\unplug('controller');
        \PMVC\unplug('view');
        \PMVC\unplug(_RUN_APP);
        \PMVC\plug(
            'view',
            [
                _CLASS => '\PMVC\FakeView',
            ]
        );
    }

    function testProcessAction()
    {
        $c = \PMVC\plug('controller');
        $c->setApp($this->_app);
        $c->plugApp(['../']);
        $result = $c->process();
        $actual = \PMVC\value($result,[0])->get('data');
        $this->haveString('This is laziness', $actual['laze_text']);
    }
}


