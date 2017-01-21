<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    /**
     * @Route("/users", name="users:list")
     */
    public function viewUsersAction(Request $request)
    {
        $userProvider = $this->get('app.user.provider');
        $users        = $userProvider->getAllUsers();

        return $this->render(':user:viewAll.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @param Request $request
     * @Route("/users/create", name="users:create")
     * @Method("POST")
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createUserAction(Request $request)
    {
        $handler = $this->get('app.handler.user');
        $data    = $request->request->all();
        $handler->handleUserCreation($data);

        return $this->redirectToRoute("users:list");
    }
}

