<?php
namespace src\core\libs\db\querybuilder;


abstract class AbstractMethodsQueryBuilder{
    protected $queryType;
    abstract public function __construct();
    abstract protected function check();
    abstract public function __toString();
}