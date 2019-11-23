<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComingSoonController extends AbstractController
{
    /**
     * @Route("/", name="coming_soon")
     */
    public function index(): Response
    {
        return $this->render('coming_soon/index.html.twig');
    }
}
