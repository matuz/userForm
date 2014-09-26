<?php

namespace Matuz\UserBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return 'user_type';
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text', ['label' => 'matuz.user.name.field_label', 'required' => true]);
        $builder->add(
            'email',
            'email',
            [
                'label' => 'matuz.user.email.field_label',
                'required' => true,
                'constraints' => [new Email(['strict' => true])]
            ]
        );
        $builder->add(
            'picture',
            'file',
            [
                'label' => 'matuz.user.picture.field_label',
                'constraints' => [new File(['mimeTypes' => ['image/jpeg', 'image/jpg']])],
                'required' => false
            ]
        );
        $builder->add('submit', 'submit');
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'Matuz\UserBundle\Entity\User'
            ]
        );
    }


}