<?php

namespace App\Controller;

use App\Entity\Pfe;
use App\Form\PfeType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pfe')]
class PfeController extends AbstractController
{
    #[Route('/list/{page<\d+>?1}/{nbre<\d+>?40}', name: 'pfe.list')]
    public function list(ManagerRegistry $doctrine, $page, $nbre)
    {
        $repository = $doctrine->getRepository(Pfe::class);
        $nbPfe = $repository->count([]);
        $nbrePage = ceil($nbPfe / $nbre);
        $pfe = $repository->findBy([], [], $nbre, ($page - 1) * $nbre);

        return $this->render(
            "pfe/list.html.twig",
            [
                'pfes' => $pfe,
                'nbrePage' => $nbrePage,
                'page' => $page,
                'nbre' => $nbre
            ]
        );
    }
    #[Route('/add', name: 'pfe.add')]
    public function add(Request $request, ManagerRegistry $doctrine, Pfe $pfe = null)
    {

        if (!$pfe) {
            $pfe = new  Pfe();
        }
        $form = $this->createForm(PfeType::class, $pfe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager = $doctrine->getManager();
            $manager->persist($pfe);
            $manager->flush();
            return $this->redirectToRoute('pfe.list');
        }
        return $this->render('pfe/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
