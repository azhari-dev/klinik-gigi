<?php
class Login extends Controller
{
    public function index()
    {
        $this->view('login/index');
        $this->view('templates/footer');
    }
}
