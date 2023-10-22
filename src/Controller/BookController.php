<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry as CustomManagerRegistry;
use phpDocumentor\Reflection\Types\True_;



class BookController extends AbstractController
{
    #[Route('/book', name: 'app_book')]
    public function index(): Response
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }
    #[Route('/listBook', name: 'list_Book')]
    public function listBook(BookRepository $repository)
    {
       // $books=$repository->findAll();
return $this->render("book/listbook.html.twig",
            array('books'=>$repository->findAll()
            ));

        /*return $this->render("book/listbook.html.twig",
            array('books'=>$repository->findBy(['published'=>false])
            )); //Nnhiib nafichi ken published tw naarja3 lil git
        */
    }

    #[Route('/addBook', name: 'add_book')]
    public function addBook(Request $request,CustomManagerRegistry $managerRegistry)
    {
        $book = new Book() ;
        $form= $this->createForm(BookType::class,$book);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $nbBooks=$book->getAuthor()->getnbBooks();// condition nhib nziid lil author illi howa zedlou kteb
           //var_dump($nbBooks).die();
            $book->getAuthor()->setnbBooks($nbBooks+1);
            $book->setPublished(true); //nhib published dima true  wken nhibha dima false nbadil true bfalse wna7ih star ken ena nhi n9arer true wela false
            $em= $managerRegistry->getManager();
            $em->persist($book);
            $em->flush();
            return new Response("Done!");
        }
        //1ere methode
        // return $this->render('book/add.html.twig',array("formulaireBook"=>$form->createView()));
        //2eme methode
        return $this->renderForm('book/add.html.twig',array("formulaireBook"=>$form));
    }
    #[Route('/updateBook/{ref}', name: 'update_book')]
    public function updateBook($ref,BookRepository $repository,Request  $request, CustomManagerRegistry $managerRegistry)
    {
        $book= $repository->find($ref) ;
        $form= $this->createForm(BookType::class, $book);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $nbBooks= $book->getAuthor()->getNbBooks();
            $book->getAuthor()->setNbBooks($nbBooks+1);
            $book->setPublished(true);
            $em = $managerRegistry->getManager();
            $em->flush();
            // return  new Response("Done!");
            return  $this->redirectToRoute("list_Book");
        }
        return $this->renderForm('book/update.html.twig',
            array('formulaireBook'=>$form));
    }
    #[Route('/deleteBook/{ref}', name: 'remove_book')]
    public function deleteBook(BookRepository $repository,$ref,
                                     CustomManagerRegistry $managerRegistry)
    {
        $book= $repository->find($ref);
        $em = $managerRegistry->getManager();
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute("list_Book");
    }
    #[Route ('/showBook/{ref}',name:'show_book')]
    public function showBook(Book $book)
    {

        return $this->render('book/show.html.twig',['book'=>$book]);
    }

}
