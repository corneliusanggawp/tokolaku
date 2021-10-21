<?php 

class Cart extends Controller {
    
    public function index()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/cart');
        $this->view('templates/FrondEndFooter');
    }
    
}