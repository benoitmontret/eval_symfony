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

    #[Route('/inventaire', name: 'inventaire')]
    public function inventaire(EntityManagerInterface $manager ): Response
    {
        $produitRepo = $manager->getRepository (Produit::class);
        $produitListe = $produitRepo->findAll();

        return $this->render('admin/produits.html.twig',
        [
            'produitListe' => $produitListe
        ]);
    }

    #[Route('/listCommentaire', name: 'listCommentaire')]
    public function listCommentaire(EntityManagerInterface $manager ): Response
    {
        $commRepo = $manager->getRepository (Commentaire::class);
        $commListe = $commRepo->findAll();

        return $this->render('admin/commentaires.html.twig',
        [
            'commListe' => $commListe
        ]);
    }
}

//Vous créerez aussi une administration contenant une page permettant de lister, ajouter, modifier ou supprimer un produit 

//ainsi qu’une page permettant de lister tous les commentaires avec la
//possibilité d’afficher un commentaire et de le supprimer.

//Seuls les utilisateurs connectés seront autorisés à accéder à ces pages d’administration
