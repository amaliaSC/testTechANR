<?php

namespace App\Controller;

use App\Entity\Rue;
use App\Form\Rue1Type;
use App\Repository\RueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/rue/controller/r')]
class RueControllerRController extends AbstractController
{
    #[Route('/', name: 'app_rue_controller_r_index', methods: ['GET'])]
    public function index(RueRepository $rueRepository): Response
    {
        return $this->render('rue_controller_r/index.html.twig', [
            'rues' => $rueRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rue_controller_r_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rue = new Rue();
        $form = $this->createForm(Rue1Type::class, $rue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rue);
            $entityManager->flush();

            return $this->redirectToRoute('app_rue_controller_r_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rue_controller_r/new.html.twig', [
            'rue' => $rue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rue_controller_r_show', methods: ['GET'])]
    public function show(Rue $rue): Response
    {
        return $this->render('rue_controller_r/show.html.twig', [
            'rue' => $rue,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rue_controller_r_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Rue $rue, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Rue1Type::class, $rue);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_rue_controller_r_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rue_controller_r/edit.html.twig', [
            'rue' => $rue,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_rue_controller_r_delete', methods: ['POST'])]
    public function delete(Request $request, Rue $rue, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rue->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($rue);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_rue_controller_r_index', [], Response::HTTP_SEE_OTHER);
    }
}
