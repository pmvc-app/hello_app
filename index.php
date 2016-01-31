<?php

$b = new PMVC\MappingBuilder();
${_INIT_CONFIG}[_CLASS] = 'NewActionName';
${_INIT_CONFIG}[_INIT_BUILDER] = $b;

$b->addAction('index', array(
    _FUNCTION => array(
        ${_INIT_CONFIG}[_CLASS],
        'index'
    )
    ,_FORM => 'HelloVerify'
));

$b->addAction('lazy-index', array(
    _FUNCTION => array(
        ${_INIT_CONFIG}[_CLASS],
        'index_laziness'
    )
));

$b->addForward('home', array(
    _PATH => 'hello'
    ,_TYPE => 'view'
    ,_ACTION => 'lazy-index'
));

$b->addForward('laze', array(
    _PATH => 'laze'
    ,_TYPE => 'view'
));

class NewActionName extends PMVC\Action
{
    static function index($m, $f){
       $go = $m['home'];
       $go->set('text',' world---'.microtime());
       return $go;
    }

    static function index_laziness($m,$f){
        $go = $m['laze'];
        $go->set('laze_text','This is laziness');
        return $go;
    }

}

class HelloVerify extends PMVC\ActionForm 
{
    function validate(){
        //PMVC\plug("adkjfa;lsdkjf");
        return true;
    }
}



