<?php

namespace App\Form;

use App\Entity\Coleccion;
use App\Entity\Fabricante;
use App\Entity\Objetos;
use App\Entity\Oleada;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ObjetosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('foto')
            ->add('precio_salida')
            ->add('precio_estimado_actual')
            ->add('fabricante', EntityType::class, [
                'class' => Fabricante::class,
'choice_label' => 'nombre',
            ])
            ->add('oleada', EntityType::class, [
                'class' => Oleada::class,
'choice_label' => 'num_oleada',
            ])
            ->add('nombre_coleccion', EntityType::class, [
                'class' => Coleccion::class,
'choice_label' => 'nombre',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Objetos::class,
        ]);
    }
}
