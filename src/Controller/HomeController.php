<?php

namespace App\Controller;

use App\Entity\Page;
use App\Entity\Settings;
use App\Repository\PageRepository;
use App\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    public function indexAction()
    {
        /** @var SettingsRepository $settingsRepository */
        $settingsRepository = $this->getDoctrine()->getRepository(Settings::class);

        $page = $settingsRepository->find(1)->getHome();

        return $this->render('page/show.html.twig', compact('page'));
    }
}
