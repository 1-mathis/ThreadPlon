<?php

namespace App\Controller;

use App\Entity\Thread;
use App\Form\EditThreadForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EditThreadController extends AbstractController
{
  #[Route('thread/edt/{id}', name: 'app_thread_edit')]
  public function edit(EntityManagerInterface $entityManager, $id, Request $request)
  {
    // Même chose qu'avant : appel du répertoire + utilisation d'une méthode, ici "find".
    $repository = $entityManager->getRepository(Thread::class);
    $thread = $repository->find($id);

    // Créer le formulaire en s'appuyant sur la configuration de ce dernier
    $form = $this->createForm(Thread::class, $thread);

    // Gérer la soumission du formulaire
    $form->handleRequest($request);

    // Lorsque formulaire est soumis, vérifier s'il est valide
    if ($form->isSubmitted() && $form->isValid()) {
      $thread->setCreatedAt(new \DateTimeImmutable);

      // Persister et enregister en base de données.
      $entityManager->persist($thread);
      $entityManager->flush();
    }

    return $this->render('thread/edit.html.twig', [
      'controller_name' => 'ThreadController',
      'form' => $form
    ]);
  }
}
