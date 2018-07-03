<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class pizzaController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function index()
    {
        $this->render('Pizza/index.html.twig');
    }
    
    // /**
    //  * @Route("/login_check", name="administration")
    //  * @Template()
    //  */
    // public function test()
    // {
    //     return new Response('<html><body>Admin page!</body></html>');
    // }

}