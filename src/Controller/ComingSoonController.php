<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ComingSoonController extends AbstractController
{
    public function indexAction(): Response
    {
        return $this->render('coming-soon/index.html.twig');
    }
}
