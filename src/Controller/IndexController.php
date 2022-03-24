<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{

    //

    #[Route('/', name: 'app_index')]
    public function index(ManagerRegistry $managerRegistry): Response
    {
        //Cette méthode affiche notre page d'accueil et la liste des Posts les plus récents
        //Nous récoupérons la liste de nos posts via l'Entity Manager et le Repository partient
        $entityManger = $managerRegistry->getManager();
        $postRepository = $entityManger->getRepository(Post::class);
        //
        $categoryRepository = $entityManger->getRepository(Category::class);
        $categories = $categoryRepository->findAll();
        //Nous récouperons notre liste de posts
        $posts = $postRepository->findBy([], ['id' => 'DESC'], 6);

        return $this->render('index/index.html.twig',
        [
            'categories' => $categories,
            'post' => $posts,
        ]);
    }

    
}
