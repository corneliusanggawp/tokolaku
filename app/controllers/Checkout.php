<?php 

class Checkout extends Controller {
    
    public function index()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/checkout');
        $this->view('templates/FrondEndFooter');
    }
    
}