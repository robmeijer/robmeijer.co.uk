<?php

namespace App\Controller\Admin;

use App\Entity\Page;
use App\Form\PageType;
use App\Repository\PageRepository;
use App\Security\PageVoter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{
    /**
     * @param int $page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        /** @var PageRepository $pageRepository */
        $pageRepository = $this->getDoctrine()->getRepository(Page::class);

        $pages = $pageRepository->findAllPaginated($page);

        return $this->render('admin/page/index.html.twig', compact('pages'));
    }

    public function newAction(Request $request)
    {
        $page = new Page();
        $page->setAuthor($this->getUser());

        $form = $this->createForm(PageType::class, $page);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();

            return $this->redirectToRoute('admin_page_index');
        }

        return $this->render('admin/page/new.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    public function editAction(Request $request, Page $page)
    {
        $this->denyAccessUnlessGranted(PageVoter::EDIT, $page);

        $form = $this->createForm(PageType::class, $page);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_dashboard_index');
        }

        return $this->render('admin/page/edit.html.twig', [
            'page' => $page,
            'form' => $form->createView(),
        ]);
    }

    public function deleteAction()
    {

    }
}
