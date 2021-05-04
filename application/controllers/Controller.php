<?php
namespace application\controllers;

class Controller
{
    public function __construct($menu, $action, $category, $idx, $pageNo)
    {
        if (!file_exists(_ROOT.'/application/models/'.$menu.'Model.php')) {
            var_dump('Model Class not found.(application/models/'.$menu.'Model.php)');
            exit();
        }
        $this->$action($category, $idx, $pageNo);
    }
}
