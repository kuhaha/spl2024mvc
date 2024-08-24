<?php
namespace spl2024\controllers;

class Program extends Controller
{
   public function listAction()
    {
       return $this->view()->render('prg_list');
    }
}   
