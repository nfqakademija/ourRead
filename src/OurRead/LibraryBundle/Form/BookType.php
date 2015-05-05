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

    public function __construct($bookInfo)
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
            ->add('title', 'text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getTitle():'',
                'attr' => array('style' => 'width: 300px')
            ))
            ->add('author', 'text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getAuthor():'',
                'attr' => array('style' => 'width: 300px')
            ))
            ->add('publisher', 'text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getPublisher():'',
                'attr' => array('style' => 'width: 300px')
            ))
            ->add('publishedDate', 'date', array(
                'data' => (is_object($this->bookInfo))?new \DateTime($this->bookInfo->getPublishedDate()):new \DateTime()
            ))
            ->add('categories', 'entity', array(
                'class' => 'OurRead\LibraryBundle\Entity\Category',
                'property' => 'category',
                'multiple' => true,
                'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('c')
                            ->orderBy('c.category', 'ASC');
                    },
                'attr' => array(
                    'class' => 'selectpicker',
                    'data-width' => '300px',
                    'title' => 'Please choose category',
                    'data-selected-text-format' => 'count>4',
                    'data-live-search' => true
                ),
            ))
            ->add('pageCount', 'text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getPageCount():'',
                'attr' => array('style' => 'width: 300px'),
            ))
            ->add('language', 'language', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getLanguage():'',
                'empty_value' => 'Please select language',
                'attr' => array(
                    'class' => 'selectpicker',
                    'data-width' => '300px',
                ),
            ))
            ->add('isbn', 'text', array(
                'label' => 'ISBN',
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getISBN():'',
                'attr' => array('style' => 'width: 300px')
            ))
            ->add('description', 'text', array(
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getDescription():''
            ))
            ->add('bookCoverByUser', 'file', array(
                'mapped' => false,
                'label' => 'Book cover',
            ))
            ->add('bookCoverByWebService', 'text', array(
                'mapped' => false,
                'label' => false,
                'data' => (is_object($this->bookInfo))?$this->bookInfo->getImageLink():'',
                'attr' => array(
                    'style'=>'display:none;'
                )
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
