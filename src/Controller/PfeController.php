<?php

namespace App\Controller;

use App\Entity\Pfe;
use App\Form\PfeType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{
    #[Route('/pfe/add', name: 'app_pfe')]
    public function add(Request $request, Pfe $pfe=null,EntityManagerInterface $manager): Response
    {
        $form=$this->createForm(PfeType::class,$pfe) ;
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager->persist($pfe);
            $manager->flush();
        }

        return $this->render('index.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    }
