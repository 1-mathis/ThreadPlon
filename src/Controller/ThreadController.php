<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\ThreadEditFormType;
use App\Form\ThreadFormType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Validator\Constraints\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ThreadController extends AbstractController
{
    #[Route('/thread', name: 'app_thread')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        $thread = new Thread();

        $form = $this->createForm(ThreadFormType::class, $thread);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $thread->setCreatedAt(new DateTimeImmutable('now'))
                ->setStatus('open')
                ->setUserId($this->getUser());
            $thread = $form->getData();

            $entityManager->persist($thread);
            $entityManager->flush();
        }

        return $this->render('thread/index.html.twig', [
            'form' => $form
        ]);
    }

    // Non fonctionnel*
    // #[Route('/thread/edit/{id}', name: 'app_thread_edit')]
    // public function update(EntityManagerInterface $entityManager, int $id, Thread $thread, Request $request): Response
    // {
    //     $repository = $entityManager->getRepository(ThreadEditFormType::class, $thread);
    //     $form = $this->createForm(ThreadEditFormType::class);
    //     $form->handleRequest($request);
    //     $thread = $repository->find($id);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //     }
    //     $entityManager->flush();

    //     return $this->render('thread/edit.html.twig', [
    //         'thread' => $thread,
    //         'form' => $form
    //     ]);
    // }
}
