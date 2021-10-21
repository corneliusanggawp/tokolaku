<?php 

class Account extends Controller {
    
    public function index()
    {
        $this->view('templates/FrondEndHeader');
        $this->view('home/account/sidemenu');
        $this->view('home/account/index');
        $this->view('templates/FrondEndFooter');
    }
}