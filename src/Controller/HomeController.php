<?php

namespace App\Controller;

use App\Entity\Thread;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/home', name: 'app_home')]
    public function affichage(EntityManagerInterface $entityManager): Response
    {

        $threadRepository = $entityManager->getRepository(Thread::class);

        $threads = $threadRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'threads' => $threads
        ]);
    }

    #[Route('/home/thread/{id}', name: 'app_thread_details')]
    public function details($id, EntityManagerInterface $entityManager): Response
    {

        $threadRepository = $entityManager->getRepository(Thread::class);

        $thread = $threadRepository->find($id);

        return $this->render('thread/details.html.twig', [
            'controller_name' => 'HomeController',
            'thread' => $thread
        ]);
    }
}
