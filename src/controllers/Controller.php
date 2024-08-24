<?php
namespace spl2024\controllers;

 abstract class Controller 
 {
     protected $model;
     protected $view;
     public function __construct($model, $view)
     {
         $this->model = $model;
         $this->view = $view;
     }
     public function model()
     {
         return $this->model;
     }
     public function view()
     {
         return $this->view;
     }

 } 
 