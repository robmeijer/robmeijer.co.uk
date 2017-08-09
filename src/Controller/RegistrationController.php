<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    public function registerAction(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder,
        TokenStorageInterface $tokenStorage
    ) {
        if ($this->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('admin_dashboard_index');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user, ['validation_groups' => ['registration']]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->authenticateUser($user, $tokenStorage);

            return $this->redirectToRoute('home');
        }

        return $this->render(
            'registration/register.html.twig',
            ['form' => $form->createView()]
        );
    }

	private function authenticateUser(User $user, TokenStorageInterface $tokenStorage)
	{
		$token = new UsernamePasswordToken($user, $user->getPassword(), 'main', $user->getRoles());

		$tokenStorage->setToken($token);
	}
}
