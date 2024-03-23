<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function admin(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/adminProd', name: 'adminProd')]
    public function adminProd(EntityManagerInterface $manager ): Response
    {
        $produitRepo = $manager->getRepository (Produit::class);
        $produitListe = $produitRepo->findAll();

        return $this->render('admin/produits.html.twig',
        [
            'produitListe' => $produitListe
        ]);
    }

    #[Route('/adminComm', name: 'adminComm')]
    public function adminComm(EntityManagerInterface $manager ): Response
    {
        $commRepo = $manager->getRepository (Commentaire::class);
        $commListe = $commRepo->findAll();

        return $this->render('admin/commentaires.html.twig',
        [
            'commListe' => $commListe
        ]);
    }
}
