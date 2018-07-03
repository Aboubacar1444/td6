<?php

namespace App\Controller;
use App\Entity\Pizzas;
use App\Entity\Ingredients;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Forms\PizzaType;
use App\Repository\PizzasRepository;


class adminController extends Controller
{
    /**
     * @Route("/admin/", name="index_admin")
     * @Template()
     */
    public function index()
    {
        return $this->render('Administration/index.html.twig');
    }

    /**
     * @Route("/admin/addPizza", name="add_pizza")
     * @Template()
     */
    public function AddPizza(Request $req)
    {
        $pizza=new Pizzas();
        $ingre=new Ingredients();
        
        $form=$this->createForm(PizzaType::class, $pizza);
        
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid())
        {
            $pizza=$form->getData();
            $pizza->addIngredient(PizzaType::$ingredient);
            $em = $this->getDoctrine()->getManager();
            $em->persist($pizza);
            // $em->persist($ingre);
            $em->flush();
            return $this->RedirectToRoute('index_admin');
        } 
        return $this->render('Administration/ajout_pizza.html.twig',array ('form'=>$form->createView()));       
    }
    
    /**
     * @Route("/admin/addIngredient", name="add_ingredient")
     * @Template()
     */
    public function addIngredient(Request $req)
    {
        $rep=$this->getDoctrine()->getRepository(Ingredients::class);
        $ingredient= new Ingredients();
        $form=$this->createFormBuilder($ingredient)
        ->add("nom",TextType::class)
        ->add('save',SubmitType::class, array('label'=>'Ajouter'))
        ->getForm();
        $form->handleRequest($req);

        if($form->isSubmitted() && $form->isValid())
        {
            $ingredient=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($ingredient);
            $em->flush();
            return $this->RedirectToRoute('index_admin');
        } 
        return $this->render('Administration/ajout_ingredient.html.twig',array ('form'=>$form->createView()));

    }
    /**
     * @Route("/admin/Pizza_ingredient", name="P_I")
     * @Template()
     */
    public function addPI(Request $req)
    {
        $em=$this->get('doctrine')->getManager();
        $pizzas= new Pizzas();
        $ingre= new Ingredients();
        $set=$pizzas->addIngredient($pizzas);
        $form=$this->createFormBuilder()
        ->add('pizza',EntityType::class, array(
           'class'=>Pizzas::class,
           'choice_label'=>'nom' 
        ))
        ->add('ingredients', EntityType::class,array(
            'class'=>Ingredients::class,
            'choice_label'=>'nom',
            
        ))
        ->add('save',SubmitType::class, array('label'=>'Relier'))
        ->getForm();
        if($form->isSubmitted() && $form->isValid())
        {
            $set=$form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($set);
            
            $em->flush();
            return $this->RedirectToRoute('index_admin');
        } 
        return $this->render('Administration/P_I.html.twig',array ('form'=>$form->createView()));


    }





}
