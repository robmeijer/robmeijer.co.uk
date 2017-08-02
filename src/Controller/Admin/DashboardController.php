<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    public function indexAction()
    {
        return $this->render('admin/dashboard/index.html.twig');
    }
}
