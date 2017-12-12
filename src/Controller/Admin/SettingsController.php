<?php

namespace App\Controller\Admin;

use App\Entity\Settings;
use App\Form\SettingsType;
use App\Repository\SettingsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class SettingsController extends AbstractController
{
    public function generalAction(Request $request)
    {
        /** @var SettingsRepository $settingsRepository */
        $settingsRepository = $this->getDoctrine()->getRepository(Settings::class);

        $settings = $settingsRepository->findAll();

        $form = $this->createForm(SettingsType::class, $settings);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_settings_general');
        }

        return $this->render('admin/settings/general.html.twig', [
            'settings' => $settings,
            'form' => $form->createView(),
        ]);
    }
}
