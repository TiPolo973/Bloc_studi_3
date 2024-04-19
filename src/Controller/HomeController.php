<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController {
    

    #[Route('/')]
    public function number() {
        $number = rand(0,100);
        return $this->render('base.html.twig',['chat' => $number ]);
    }


}