<?php

namespace App\Controller;

use App\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    public function showAction(Page $page)
    {
        return $this->render('page/show.html.twig', compact('page'));
    }
}
