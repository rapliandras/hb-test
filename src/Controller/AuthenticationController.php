<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticatorManager;

#[Route('/auth')]
class AuthenticationController extends AbstractController
{
    #[Route('/login')]
    public function loginAction(Request $request, AuthenticatorManager $authenticatorManager)
    {
        $username = $request->get('username');
        $password = $request->get('password');

        $authenticatorManager->authenticateUser($username);
    }
}