<?php
/**
 * Created by PhpStorm.
 * User: amine
 * Date: 19/10/2015
 * Time: 0:46
 */

class Controller
{
    /**
     * @param string $model
     * @return mixed
     */
    public function model($model)
    {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    /**
     * Call the view passing array of data
     * @param string $view
     * @param array $data
     */
    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.php' ;
    }
}