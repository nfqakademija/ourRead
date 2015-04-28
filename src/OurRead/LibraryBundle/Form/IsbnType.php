<?php
/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/28/15
 * Time: 9:54 PM
 */

namespace OurRead\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Class IsbnType
 * @package OurRead\LibraryBundle\Form
 */
class IsbnType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('isbn', 'text', array(
                'label' => 'Fill book data by ISBN',
                'attr' => array('style' => 'width: 300px')
            ))
            ->add('search', 'submit', array(
                'attr' => array(
                    'class'=>'btn-info'
                )
            ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'isbn_type';
    }

}
