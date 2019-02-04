<?php
/**
 * Created by PhpStorm.
 * User: ftrankimquan2018
 * Date: 04/02/2019
 * Time: 17:03
 */

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    /**
     * @Route(
     *     "/register",
     *     name="app_register",
     *     methods={"GET","POST"}
     *     )
     */
    public function register(UserPasswordEncoderInterface $encoder, Request $request)
    {
        $user = new User();
        $registerForm= $this->createForm(RegisterType::class);
        $this->render('security/register.html.twig',[
            'user'=>$user
        ]);
    }



}