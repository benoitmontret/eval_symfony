<?php

namespace App\DataFixtures;

use App\Entity\Produit;
use App\Entity\Commentaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $commentaire1 = new Commentaire();
        $commentaire1 -> setTitre("Super !")
                        ->setContenu("Excellent jeu avec un très bon matériel.");
        $manager->persist($commentaire1);
        $commentaire2 = new Commentaire();
        $commentaire2 -> setTitre("Excellent")
                        ->setContenu("Les parties s'enchainent et on devient rapidement addict.");
        $manager->persist($commentaire2);
        $commentaire3 = new Commentaire();
        $commentaire3 -> setTitre("Super !")
                        ->setContenu("Bon jeu, simple, réfléchi. Il sort souvent");
        $manager->persist($commentaire3);
        $commentaire4 = new Commentaire();
        $commentaire4 -> setTitre("Super")
                        ->setContenu("Excellent jeu avec un très bon matériel.");
        $manager->persist($commentaire4);
        $commentaire5 = new Commentaire();
        $commentaire5 -> setTitre("Excellent")
                        ->setContenu("Bon jeu, simple, réfléchi. Il sort souvent");
        $manager->persist($commentaire5);
        $commentaire6 = new Commentaire();
        $commentaire6 -> setTitre("Trop bien")
                        ->setContenu("Bon jeu, simple, réfléchi. Il sort souvent");
        $manager->persist($commentaire6);
        $commentaire7 = new Commentaire();
        $commentaire7 -> setTitre("Super !")
                        ->setContenu("Les parties s'enchainent et on devient rapidement addict.");
        $manager->persist($commentaire7);
        $commentaire8 = new Commentaire();
        $commentaire8 -> setTitre("Fun")
                        ->setContenu("Bon jeu, simple, réfléchi. Il sort souvent");
        $manager->persist($commentaire8);
        $commentaire9 = new Commentaire();
        $commentaire9 -> setTitre("Excellent")
                        ->setContenu("Les parties s’enchaînent et on devient rapidement addict.");
        $manager->persist($commentaire9);
        $commentaire10 = new Commentaire();
        $commentaire10 -> setTitre("Super")
                        ->setContenu("Excellent jeu avec un très bon matériel.");
        $manager->persist($commentaire10);
        $commentaire11 = new Commentaire();
        $commentaire11 -> setTitre("Fun")
                        ->setContenu("Bon jeu, simple, réfléchi. Il sort souvent");
        $manager->persist($commentaire11);

        $produit1 = new Produit();
        $produit1 -> setNom("7 Wonders")
                    -> setDescription("7 Wonders, le jeu de civilisation stratégique revient dans une nouvelle formule ! Draftez les meilleurs cartes, bâtissez votre Merveille et dominez l'Antiquité.")
                    -> setImage('images/7-wonders.webp')
                    -> setStock("8")
                    -> addCommentaire($commentaire1)
                    -> addCommentaire($commentaire2);
                    
        $manager->persist($produit1);

        $produit2 = new Produit();
        $produit2 -> setNom("Abyss")
                    -> setDescription("Le pouvoir d'Abyss est de nouveau vacant. Usez de toute votre ruse pour obtenir des voix au Conseil, recruter les seigneurs et abuser de leurs pouvoirs.")
                    -> setImage("images/abyss.webp")
                    -> setStock("21")
                    -> addCommentaire($commentaire3)
                    -> addCommentaire($commentaire4);
        $manager->persist($produit2);

        $produit3 = new Produit();
        $produit3 -> setNom("Colt Express")
                    -> setDescription("Dans Colt Express, incarnez des bandits à l'attaque d'un train de voyageurs. Tentez d'éviter le Marshall et les blessures par balles et récupérez l'or !")
                    -> setImage('images/colt-express.webp')
                    -> setStock("6")
                    -> addCommentaire($commentaire5)
                    -> addCommentaire($commentaire6);
        $manager->persist($produit3);

        $produit4 = new Produit();
        $produit4 -> setNom("Dune Imperium")
                    -> setDescription("Dune Imperium est un jeu de deckbuilding et de placement d'ouvriers adapté de l'œuvre de science-fiction mythique de Frank Herbert, avec un thème important.")
                    -> setImage('images/dune-imperium.webp')
                    -> setStock("14")
                    -> addCommentaire($commentaire7)
                    -> addCommentaire($commentaire8);
        $manager->persist($produit4);

        $produit5 = new Produit();
        $produit5 -> setNom("Les Aventuriers du Rail")
                    -> setDescription("Prenez le contrôle des chemins de fer reliant les villes des États-Unis dans Les Aventuriers du Rail, le jeu de stratégie ferroviaire !")
                    -> setImage('images/les_aventuriers_du_rail.png')
                    -> setStock("22")
                    -> addCommentaire($commentaire9);
        $manager->persist($produit5);

        $produit6 = new Produit();
        $produit6 -> setNom("Pandemic")
                    -> setDescription("Combattez le fléau et sauvez la planète dans Pandemic, le jeu de coopération où vous devez éradiquer les maladies qui se développent sur la planète !")
                    -> setImage('images/pandemic.png')
                    -> setStock("12")
                    -> addCommentaire($commentaire10);
        $manager->persist($produit6);

        $produit7 = new Produit();
        $produit7 -> setNom("The 7th Continent")
                    -> setDescription("The 7th Continent est un jeu d'exploration et de survie pour 1 à 4 joueurs, inspiré des livres d'aventure où VOUS êtes le héros. Vous jouez le rôle d'un explorateur du début du 20ème siècle qui revient d'une expédition sur le 7ème continent nouvellement découvert, une terre mystérieuse et hostile inspirée par Jules Verne et H.P. Lovecraft.")
                    -> setImage('images/the-7th-continent.webp')
                    -> setStock("15")
                    -> addCommentaire($commentaire11);
        $manager->persist($produit7);


        $manager->flush();
    }
}
