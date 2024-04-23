<?php

namespace App\Controller;

use App\Entity\Ville;
use App\Form\Ville1Type;
use App\Repository\VilleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/ville/controller/v')]
class VilleControllerVController extends AbstractController
{
    #[Route('/', name: 'app_ville_controller_v_index', methods: ['GET'])]
    public function index(VilleRepository $villeRepository): Response
    {
        return $this->render('ville_controller_v/index.html.twig', [
            'villes' => $villeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ville_controller_v_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $ville = new Ville();
        $form = $this->createForm(Ville1Type::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ville);
            $entityManager->flush();

            return $this->redirectToRoute('app_ville_controller_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ville_controller_v/new.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ville_controller_v_show', methods: ['GET'])]
    public function show(Ville $ville): Response
    {
        return $this->render('ville_controller_v/show.html.twig', [
            'ville' => $ville,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ville_controller_v_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Ville $ville, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Ville1Type::class, $ville);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_ville_controller_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ville_controller_v/edit.html.twig', [
            'ville' => $ville,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ville_controller_v_delete', methods: ['POST'])]
    public function delete(Request $request, Ville $ville, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ville->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($ville);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_ville_controller_v_index', [], Response::HTTP_SEE_OTHER);
    }
}
