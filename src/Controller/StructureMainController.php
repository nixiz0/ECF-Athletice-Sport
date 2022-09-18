<?php

namespace App\Controller;

use App\Entity\StructureMain;
use App\Form\StructureMainType;
use App\Repository\OptionRepository;
use App\Repository\StructureMainRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/structure/main')]
class StructureMainController extends AbstractController
{
    #[Route('/', name: 'app_structure_main_index', methods: ['GET'])]
    public function index(StructureMainRepository $structureMainRepository, OptionRepository $optionRepository): Response
    {
        return $this->render('structure_main/index.html.twig', [
            'structures' => $structureMainRepository->findAll(),
            'options' => $optionRepository->findAll(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_structure_main_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, StructureMain $structureMain, StructureMainRepository $structureMainRepository): Response
    {
        $form = $this->createForm(StructureMainType::class, $structureMain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $structureMainRepository->add($structureMain, true);

            return $this->redirectToRoute('app_structure_main_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('structure_main/edit.html.twig', [
            'structure_main' => $structureMain,
            'form' => $form,
        ]);
    }
}