<?php

namespace App\Form;

use App\Entity\Offre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OffreFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', options:[
                'label' => 'Nom de l\'offre'
            ])
            ->add('Description', options:[
                'label' => 'Description de l\'offre'
            ])
            ->add('Prix', MoneyType::class, options:[
                'label' => 'Prix',
                'divisor' => 100
            ])
            ->add('Ordre',options:[
                'label' => 'Ordre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offre::class,
        ]);
    }
}
