<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 5/18/15
 * Time: 11:36 PM
 */

namespace OurRead\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class CategoryType
 * @package LibraryBundle\Form\Type
 */
class CategoryFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', 'entity', array(
                'class' => 'OurRead\LibraryBundle\Entity\Category',
                'property' => 'category',
                'multiple' => true,
                'required' => true,
                'attr' => array(
                    'class' => 'selectpicker category-filter',
                    'data-width' => '300px',
                    'title' => 'Please choose category',
                    'data-selected-text-format' => 'count>4',
                    'data-live-search' => true
                ),
            ));
    }


    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => 'OurRead\LibraryBundle\Entity\Category',
            ]
        );
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'category_type';
    }
}
