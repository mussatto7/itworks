<?php

namespace Itworks\src\controller;
use Itworks\core\Controller;

class SiteController extends Controller
{
    public function index()
    {
        $this->load('site\index');
    }

    public function funciona()
    {
        $this->load('site\funciona');
    }

    public function home()
    {
        $this->load('site\home');
    }

    public function institucional()
    {
        $this->load('site\institucional');
    }

    public function cadastar()
    {
        $this->load('site\cadastrar');
    }

    public function empresa()
    {
        $this->load('site\empresa');
    }
}
