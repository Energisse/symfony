<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    
    /**
     * @Route("/inscription", name="app_inscription")
     */
    public function inscription(Request $request,EntityManagerInterface $entityManager,UserPasswordEncoderInterface $encoder): Response
    {   
        $user = new User();

        $formulaire = $this->createForm(UserType::class,$user);

        $formulaire->handleRequest($request);
        if($formulaire->isSubmitted() && $formulaire->isValid()){
            $user = $formulaire->getData();

            $encoded = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute("app_login");
        }


        return $this->render('security/inscription.html.twig', [
            'formulaire' => $formulaire->createView(),
        ]);
    }
}
