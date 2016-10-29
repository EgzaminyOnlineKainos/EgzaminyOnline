<?php

namespace App\Http\Controllers;

use App\Entities\Scientist;
use Doctrine\ORM\Entity;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function __construct()
    {
        $this->middleware('web');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($name, $lastname, $color)
    {
        $person = new Scientist();
        $person->setFirstname($name);
        $person->setLastname($lastname);
        $person->setColor($color);

        $em = app("em"); //Alias Entity Manager
        $em->persist($person);
        $em->flush();

        return redirect('/');
    }

    public function destroy($id)
    {
        /** @var $em EntityManager */
        $em = app("em"); //Alias Entity Manager
        $person = $em->find(Scientist::class, $id);

        $em->remove($person);
        $em->flush();

        return redirect('/');
    }
}
