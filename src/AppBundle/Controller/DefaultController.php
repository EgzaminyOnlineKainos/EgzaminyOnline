<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="index")
     */
    public function indexAction(Request $request)
    {
        if ($this->isGranted("ROLE_ADMIN")) {
            return $this->redirectToRoute('default:home:admin');
        } else {
            return $this->redirectToRoute('student:index');
        }
    }

    /**
     * @Route("/admin", name="default:home:admin")
     */
    public function adminHomeAction(Request $request)
    {
        return $this->render(':default:index.html.twig', [
            'numOfUsers' => 12,
            'numOfExams' => 1,
            'numOfTasks' => 16,
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error               = $authenticationUtils->getLastAuthenticationError();
        $lastUsername        = $authenticationUtils->getLastUsername();

        return $this->render('default/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/dev/createUser")
     */
    public function createUser()
    {
        $userCreator = $this->get('app.service.user_creator');
        $user        = new User();
        $user->setPassword("root");
        $user->setUsername("root@egzaminy");
        $user->setDisplayName("ROOT");
        $user->setType("admin");
        $userCreator->createUser($user);

        $user        = new User();
        $user->setPassword("student");
        $user->setUsername("student@egzaminy");
        $user->setDisplayName("San Escobar");
        $user->setType("student");
        $userCreator->createUser($user);

        return new Response("ok", 200);
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {

    }
}
