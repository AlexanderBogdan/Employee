<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Male' => 'm',
                    'Female' => 'f',
                ],
                'placeholder' => 'Choose your gender',
                'empty_data'  => null
            ])
            ->add('birthdate', DateType::class, [
                'years' => range(date('Y') - 65, date('Y') - 18)
            ])
            ->add('salary', MoneyType::class)
            ->add('comment')
        ;

        $builder->add('phones', CollectionType::class, [
            'entry_type' => PhoneType::class,
            'allow_add'    => true,
            'by_reference' => false,
        ]);

        $builder->add('addresses', CollectionType::class, [
            'entry_type' => AddressType::class,
            'allow_add'    => true,
            'by_reference' => false,
        ]);
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Employee'
        ));
    }
}
