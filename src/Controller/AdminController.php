<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use App\Entity\Commentaire;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/', name: 'admin')]
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
    #[Route('/addProduit', name: 'addProduit')]
    public function addProduit(EntityManagerInterface $manager, Request $request): Response
    {
        $produit = new Produit();
        $form = $this->createForm(ProduitType::class, $produit);

        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit =$form ->getData();
            $manager->persist($produit);
            $manager->flush();
            $this -> addFlash('success', 'Le produit à été ajouté');
            return $this->redirectToRoute('inventaire');
        }

        return $this->render('admin/addProduit.html.twig', ["form"=>$form->createView()]);
    }
    #[Route('/editProduit/{id}', name: 'editProduit')]
    public function editProduit(Produit $produit, EntityManagerInterface $manager, Request $request): Response
    {
        $form = $this->createForm(ProduitType::class, $produit);

        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $produit =$form ->getData();
            $manager->persist($produit);
            $manager->flush();
            $this -> addFlash('success', 'Le produit a été modifié');

            return $this->redirectToRoute('inventaire');
        }

        return $this->render('admin/editProduit.html.twig', ["form"=>$form->createView()]);
    }
    #[Route('/deleteProduit/{id}', name: 'deleteProduit')]
    public function deleteProduit(Produit $produit, EntityManagerInterface $manager,):Response
    {
        foreach ($produit->getCommentaires() as $commentaire) {
            $manager->remove($commentaire);
        }
        $manager->remove($produit);
        $manager->flush();
        $this -> addFlash('delete', 'Le produit à été supprimé');

        return $this->redirectToRoute('inventaire');
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

    #[Route('/afficherComm/{id}', name: 'afficherComm')]
    public function afficherComm(Commentaire $commentaire,EntityManagerInterface $manager): Response
    {
        return $this->render('admin/afficherComm.html.twig', [
            'Commentaire' => $commentaire,
        ]);
    }

    #[Route('/deleteCommentaire/{id}', name: 'deleteCommentaire')]
    public function deleteCommentaire(Commentaire $commentaire, EntityManagerInterface $manager,):Response
    {
        $manager->remove($commentaire);
        $manager->flush();
        $this -> addFlash('delete', 'Le commentaire à été supprimé');

        return $this->redirectToRoute('listCommentaire');
    }

}


//ainsi qu’une page permettant de lister tous les commentaires avec la
//possibilité d’afficher un commentaire et de le supprimer.

//Seuls les utilisateurs connectés seront autorisés à accéder à ces pages d’administration
