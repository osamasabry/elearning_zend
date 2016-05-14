<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initRequest() {
            $this->bootstrap('FrontController');
            $front = $this->getResource('FrontController');
            $request = new Zend_Controller_Request_Http();
            $front->setRequest($request);
        }

    protected function _initPlaceholders() {
        $this->bootstrap('View');
        $view = $this->getResource('View');
        $layout = $this->getResource('Layout');

         // var_dump($this->view);die;
        
        // echo $this->layout->getLayout();die;

        $view->doctype('HTML5');
        //Meta
        $view->headMeta()->appendName('keywords', 'framework, PHP')->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');

        $view->headTitle('SLMS Site')->setSeparator(' : ');
        // Set the initial stylesheet:

        
        //admin
        // if($layout == 'admin-layout'){

            $view->headLink()->appendStylesheet($view->baseUrl().'/css/emy.css');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css/style1.css');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css/bootstrap.min1.css');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css/icon-font.min.css');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css/font-awesome.css');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css?family=Montserrat:400,700');
            $view->headLink()->appendStylesheet($view->baseUrl().'/css?family=Roboto:700,500,300,100italic,100,400');
        
            //admin
            $view->headScript()->appendFile($view->baseUrl().'/js/amcharts.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/serial.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/light.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/jquery-1.10.2.min.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/owl.carousel.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/jquery.flot.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/jquery.nicescroll.js');
          
            $view->headScript()->appendFile($view->baseUrl().'/js/scripts.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/bootstrap.min.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/jquery.flot.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/jquery.fn.gantt.js');
            $view->headScript()->appendFile($view->baseUrl().'/js/menu_jquery.js');

        // }elseif($layout == 'layout') {
          
        
        
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/bootstrap.min.css');
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/camera.css');
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/style.css');
        $view->headLink()->appendStylesheet($view->baseUrl().'/css/s.css');
        
         
        // Set the initial JS to load:
        $view->headScript()->appendFile($view->baseUrl().'/js/jquery.min.js');
        $view->headScript()->appendFile($view->baseUrl().'/js/camera.min.js');
        $view->headScript()->appendFile($view->baseUrl().'/js/jquery.easing.1.3.js');
        $view->headScript()->appendFile($view->baseUrl().'/js/jquery.mobile.customized.min.js');
        
        // }
    }   

    protected function _initSession() {
        Zend_Session::start();
        $session = new Zend_Session_Namespace('Zend_Auth');
    }
}
