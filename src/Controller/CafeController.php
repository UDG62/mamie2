<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TypeCafeRepository;
use App\Entity\TypeCafe;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ModifierCafeType;
use App\Form\SupprimerCafeType;

class CafeController extends AbstractController
{
    #[Route('/liste-cafes', name: 'app_liste-cafes')]
public function listeCafes(Request $request,TypeCafeRepository $TypeCafeRepository): Response
{
    $TypeCafe = $TypeCafeRepository->findAll();
    $form = $this->createForm(SupprimerCafeType::class, null, [
        'TypeCafe' => $TypeCafe
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $selectedCafe = $form->get('TypeCafe')->getData();
            foreach ($selectedCage as $TypeCafe) {
            $em->remove($TypeCafe);
            }
            $em->flush();
            $this->addFlash('notice', 'Cafés supprimées avec succès');
            return $this->redirectToRoute('app_liste-cafes');
            }
return $this->render('cafes/liste-cafes.html.twig', [
    'TypeCafe' => $TypeCafe,
    'form' => $form->createView(),
]);
}
    #[Route('/modifier-cafe/{id}', name: 'app_modifier_cafe')]
    public function modifierCafe(Request $request,TypeCafe $TypeCafe,EntityManagerInterface $em): Response
{
    $form = $this->createForm(ModifierCafeType::class, $TypeCafe);
    if($request->isMethod('POST')){
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
        $em->persist($TypeCafe);
        $em->flush();
        $this->addFlash('notice','café modifiée');
        return $this->redirectToRoute('app_liste-cafes');
        }
        }
return $this->render('cafes/modifier-cafe.html.twig', [
    'form' => $form->createView()
]);
}
        #[Route('/supprimer-cafe/{id}', name: 'app_supprimer_cafe')]
        public function supprimerCafe(Request $request,TypeCafe
        $TypeCafe,EntityManagerInterface $em): Response
        {
        if($TypeCafe!=null){
        $em->remove($TypeCafe);
        $em->flush();
        $this->addFlash('notice','Café supprimée');
        }
        return $this->redirectToRoute('app_liste-cafes');
        }
}
