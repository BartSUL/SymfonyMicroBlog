<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Tag;
use App\Entity\Post;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //Test de création de plusierus Entity de type Post, Category, et Tag

        //Nous créons une série de Tags que nous stockons dans un tableau:
        $tags = [];
        for($i=0; $i<35; $i++){
            $tag = new Tag;
            $tag->setName("Tag #", rand(100, 999));
            //On ajoute le tag au tableau de tags afin de ne pas le perdre
            array_push($tags, $tag);
            $manager->persist($tag);//demande de persistance
        }

        $categoryNames = ["Rouge", "Vert", "Bleu", "Jaune", "Noir", "Argent", "Indigo"];
        $categories = [];
        //
        foreach($categoryNames as $categoryName){
            $category = new Category;
            $category->setName($categoryName);
            $category->setDescription("Lorem Ipsum etc");
            $manager->persist($category);
            //
            array_push($categories, $category);

        }
        
        for($i=0; $i<20; $i++){//Nous créons autant de Posts que la valeur max de $i
            $post = new Post;
            $post->setCategory($categories[rand(0, (count($categories) - 1))]);
            if(rand(1,10) > 5){//Une chance sur deux de renseigner cet attribut
                $post->setTitle(uniqid());
            }
            if(rand(1,10) > 5){//Une chance sur deux de renseigner cet attribut
                $post->setText("lorem ipsum");
            }
            foreach($tags as $tag){
            //Nous parcourons tous les tags créés, et nous décidons d'attacher chaque Tag au Post actuellement en cours de création une chance sur cinq
                if(rand(1,10) > 8){
                $post->addTag($tag);
                }
            }
            $manager->persist($post);
        }

        $manager->flush();
    }
}
