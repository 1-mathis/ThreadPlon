<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\ThreadFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThreadController extends AbstractController
{
    // #[Route('/thread', name: 'app_thread')]
    // public function index(Request $request): Response
    // {
    //     $thread = new Thread();
    //     $form = $this->createForm(ThreadFormType::class, $thread);

    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) {

    //         return $this->redirectToRoute('home/index.html.twig');
    //     }

    //     return $this->render('thread/index.html.twig', [
    //         'form' => $form->createView(),
    //     ]);
    // }

    #[Route('/thread', name: 'app_thread')]
    public function index(EntityManagerInterface $entityManager, Request $request): Response
    {
        $thread = new Thread();
        $form = $this->createForm(ThreadFormType::class, $thread);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $thread = $form->getData();

            $entityManager->persist($thread);
            $entityManager->flush();
        }

        return $this->render('thread/index.html.twig', [
            'form' => $form
        ]);
    }
}
