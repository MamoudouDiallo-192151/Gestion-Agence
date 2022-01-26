<?php

namespace App\Form;

use App\Entity\PropertySearch;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('maxPrice', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Budget maximale']
            ])
            ->add('minSurface', IntegerType::class, [
                'required' => false,
                'label' => false,
                'attr' => ['placeholder' => 'Surface minimale']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            //get pour que les personnes puissent partager leurs recherchent
            'method' => 'get',
            'csrf_protectation' => false,
        ]);
    }
    /**
     * permet une utilisation  correcte des parametres  de recherch dans l'url
     *
     * @return void
     */
    public function getBlockPrefix()
    {
        return '';
    }
}
