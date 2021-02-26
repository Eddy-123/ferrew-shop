<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MainController extends AbstractController
{
    /**
     * @var UserPasswordEncoderInterface 
     */
    public $userPasswordEncoder;
    
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder) {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }
    
    /**
     * @Route("/", name="main_home")
     */
    public function home(ArticleRepository $repository): Response
    {
        //$this->test();
        $articles = $repository->findAll();
        return $this->render('main/home.html.twig', [
            "articles" => $articles
        ]);
    }
    
    /*connexion, inscription, produit*/
    
    private function test() {
        $user = new User();
        $user->setEmail("ferrew-shop@gmail.com")
                ->setPassword($this->userPasswordEncoder->encodePassword($user, "ferrew-shop"));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
    }
}
