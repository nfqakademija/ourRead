<?php

/**
 * Created by PhpStorm.
 * User: povilas
 * Date: 4/19/15
 * Time: 10:32 PM
 */

namespace OurRead\LibraryBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class BookType extends AbstractType
{
    private $bookInfo;

    function __construct($bookInfo)
    {
        $this->bookInfo = $bookInfo;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title','text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getTitle():''
            ))
            ->add('author','text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getAuthor():''
            ))
            ->add('publisher','text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getPublisher():''
            ))
            ->add('publishedDate','date', array(
                'data' => (is_object($this->bookInfo))?new \DateTime($this->bookInfo->getPublishedDate()):new \DateTime()
            ))
            ->add('description','text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getDescription():''
            ))
            ->add('categories','entity', array(
                'class' => 'OurRead\LibraryBundle\Entity\Category',
                'property' => 'category',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.category', 'ASC');
                    },
            ))
            ->add('pageCount','text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getPageCount():''
            ))
            ->add('language','language', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getLanguage():'',
                'empty_value' => 'Please select language'
            ))
            ->add('isbn','text', array(
                'label' => 'ISBN',
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getISBN():'',
            ))
            ->add('bookCover', 'file', array(
                'mapped' => false
            ))
            ->add('Submit', 'submit', array(
                'label' => 'Add Book',
                'attr' => array(
                    'class'=>'btn-success'
                )
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'OurRead\LibraryBundle\Entity\Book'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'book_type';
    }

}
