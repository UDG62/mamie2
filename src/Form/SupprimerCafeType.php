<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\TypeCafe;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SupprimerCafeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('TypeCafe', EntityType::class, [
            'class' => TypeCafe::class,
            'choices' => $options['TypeCafe'],
            'choice_label' => 'designation',
            'expanded' => true,
            'multiple' => true,
            'label' => false, 'mapped' => false])
            ->add('supprimer', SubmitType::class, ['attr' => ['class'=> 'btn bg-primary text-white m-4' ],
'row_attr' => ['class' => 'text-center'],]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'TypeCafe' => []
        ]);
    }
}
