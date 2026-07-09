<?php

class HomeController extends Controller
{
    // Affiche la page d'accueil (test provisoire de la chaîne complète)
    public function index()
    {
        $this->render('home/index');
    }
}