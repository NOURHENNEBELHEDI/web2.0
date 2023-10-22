<?php

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as CustomManagerRegistry;
use App\Entity\Author;
<<<<<<< HEAD
use App\Entity\Book;
=======
>>>>>>> 3b0e16860b787fd0c263df6102f3ddf95c12a14f

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }

    #[Route('/showAuthor/{name}', name: 'app_showAuthor')]

    public function showAuthor($name){
        return $this->render('author/showAuthor.html.twig', ['n' => $name,]);
    }
    #[Route('/list', name: 'list_author')]
    public function listAuthor()
    {
        $authors = array(
            array('id' => 1, 'username' => ' Victor Hugo','email'=> 'victor.hugo@gmail.com', 'nb_books'=> 100),
            array ('id' => 2, 'username' => 'William Shakespeare','email'=>
                'william.shakespeare@gmail.com','nb_books' => 200),
            array('id' => 3, 'username' => ' Taha Hussein','email'=> 'taha.hussein@gmail.com','nb_books' => 300),
        );

        return $this->render("author/list.html.twig",

                ['Authors'=>$authors]
            );
    }
    #[Route('/author/{id}', name: 'author_details')]
    public function authorDetails($id)
    {
        $authors = array(
            array('id' => 1, 'username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com', 'nb_books' => 100,'image'=>'imgs/1.jfif'),
            array('id' => 2, 'username' => 'William Shakespeare', 'email' => 'william.shakespeare@gmail.com', 'nb_books' => 200,'image'=>'imgs/2.jfif'),
            array('id' => 3, 'username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300,'image'=>'imgs/3.jfif'),
        );


        $author = null;
        foreach ($authors as $a) {
            if ($a['id'] == $id) {
                $author = $a;
                break;
            }
        }

    }
   #afficher Author
    #[Route('/listAuthor', name: 'app_listAuthor')]
    public function list(AuthorRepository $repository)
    {
        $authors=$repository->findAll();
        return $this->render("author/listAuthor.html.twig", array('Authors'=>$authors));
    }

    #[Route('/addAuthorstat', name: 'app_add_authorstat')]
    public function addAuthorstat(CustomManagerRegistry $managerRegistry)
    {
        #creez une instance de l'entite Author
        $author= new Author();
        $author->setUsername("nourhenne belhedi");
        $author->setEmail("nourhenne.belhedi@esprit.tn");
        // $em= $this->getDoctrine()->getManager();
        $em= $managerRegistry->getManager();
        $em->persist($author);
        $em->flush();
        return $this->redirectToRoute("app_listAuthor");

    }
    #[Route('/updateAuthorstat/{id}', name: 'update_authors')]
    public function updateAuthorstat($id,AuthorRepository $repository,CustomManagerRegistry $managerRegistry)
    {
        $author= $repository->find($id);
        $author->setEmail("eya.ali@esprit.tn");
        $author->setUsername("eya ali");
        // $em= $this->getDoctrine()->getManager();
        $em= $managerRegistry->getManager();
        $em->flush();
        return $this->redirectToRoute("app_listAuthor");
    }

    #[Route('/deleteAuthorstat/{id}', name: 'remove_authors')]
    public function deleteAuthorstat(AuthorRepository $repository,$id,
                                 CustomManagerRegistry $managerRegistry)
    {
        $author= $repository->find($id);
        $em = $managerRegistry->getManager();
        $em->remove($author);
        $em->flush();
        return $this->redirectToRoute("app_listAuthor");
    }

}