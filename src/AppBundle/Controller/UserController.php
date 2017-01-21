<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
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

    /**
     * @param $uid
     * @Route("/users/{uid}", name="users:edit")
     */
    public function editUser($uid)
    {

    }

    /**
     * @param $uid
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Route("/users/{uid}/remove", name="users:remove")
     *
     */
    public function removeUserAction($uid)
    {
        if ($uid == $this->getUser()->getId()) {
            $this->addFlash('error', 'You are not allowed to remove yourself');

            return $this->redirectToRoute("users:list");
        }

        $provider = $this->get('app.user.provider');
        $remover  = $this->get('app.service.user_remover');
        $user     = $provider->getUser($uid);

        if ($user instanceof User) {
            $remover->removeUser($user);
            $this->addFlash('success', 'User has been succesfully removed');
        } else {
            $this->addFlash('error', 'User cannot be found');
        }

        return $this->redirectToRoute("users:list");
    }
}

