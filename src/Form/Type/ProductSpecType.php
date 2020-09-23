<?php
namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\ProductSpec;
use App\Entity\SpecDefinition;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Form\DataTransformer\JsonToPrettyJsonTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSpecType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder->add('spec', EntityType::class, [
            'class' => SpecDefinition::class,
            'choice_label' => 'name'
        ]);
        $builder->add('value');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductSpec::class
        ]);
    }
}