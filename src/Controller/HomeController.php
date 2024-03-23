<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Entity\Commentaire; 
use App\Form\CommentaireType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Loader\Configurator\form;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    #[Route('/accueil', name: 'accueil')]
    public function accueil(EntityManagerInterface $manager ): Response
    {
        $produitRepo = $manager->getRepository (Produit::class);
        $produitListe = $produitRepo->findBy([], ['id' => 'desc'], 5);

        return $this->render('home/accueil.html.twig',
        [
            'produitListe' => $produitListe
        ]);
    }
    #[Route('/produits', name: 'produits')]
    public function produits(EntityManagerInterface $manager ): Response
    {
        $produitRepo = $manager->getRepository (Produit::class);
        $produitListe = $produitRepo->findAll();

        return $this->render('home/produits.html.twig',
        [
            'produitListe' => $produitListe
        ]);
    }

    #[Route('/produit/{id}', name: 'produit')]
    public function produit(Produit $produit,EntityManagerInterface $manager, Request $request): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setProduit($produit);
        $form = $this->createForm(CommentaireType::class, $commentaire);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $commentaire =$form ->getData();
            $manager->persist($commentaire);
            $manager->flush();
            return $this->redirectToRoute('produit', ['id' => $produit->getId()]);
        }


        return $this->render('home/produit.html.twig', [
            'produit' => $produit,
            'form'=>$form->createView()

        ]);
    }






}
