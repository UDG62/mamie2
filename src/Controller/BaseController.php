<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\TypeCafeType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\TypeCafe;
use Doctrine\ORM\EntityManagerInterface;

class BaseController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
        ]);
    }
    #[Route('/cafe', name: 'app_cafe')]
    public function cafe(Request $request, EntityManagerInterface $em): Response
    {
        $cafe = new TypeCafe();
    $form = $this->createForm(TypeCafeType::class, $cafe);
    if($request->isMethod('POST')){
        $form->handleRequest($request);
        if ($form->isSubmitted()&&$form->isValid()){
            $em->persist($cafe);
            $em->flush();
            $this->addFlash('notice','Café envoyé');
            return $this->redirectToRoute('app_cafe');
        }
        }
    return $this->render('base/cafe.html.twig', [
        'form' => $form->createView()
    ]);
    }
}
