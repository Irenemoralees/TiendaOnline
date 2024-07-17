<?php

namespace App\Form;

use App\Entity\Articulo;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ResetType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use function PHPSTORM_META\type;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('image')
            ->add('description')
            ->add('price')
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'type',
                'multiple' => true,
                'espanded' => true,
            ])
            ->add('Enviar', SubmitType::class)
            ->add(child: 'Resetear', type: ResetType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articulo::class,
        ]);
    }
}
