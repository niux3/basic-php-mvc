<?php
namespace src\core\libs\db\querybuilder;

interface IQueryBuilderStrategy{
    public function execute();
}