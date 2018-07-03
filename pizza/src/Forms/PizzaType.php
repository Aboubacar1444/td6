<?php
namespace App\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Pizzas;
use App\Entity\Ingredients;


class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder
            ->add('nom')
            ->add('prix')
            ->add('description')
            ->add('ingredients', TextareaType::class)
            ->add('save',SubmitType::class, array('label'=>'Ajouter'))
            ;
    }

    public function getName()
    {
        return 'pizza_form';
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\Pizzas',
        ]);
    }

}