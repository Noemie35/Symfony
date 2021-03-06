<?php

namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdvertType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('date',      'date')
      ->add('title',     'text')
      ->add('author',    'text')
      ->add('content',   'textarea')
      ->add('categories', 'entity', array(
        'class'    => 'BlogBundle:Category',
        'property' => 'name',
        'multiple' => true,
        'expanded' => true
      ))
      ->add('tags', 'entity', array(
        'class'    => 'BlogBundle:Tag',
        'property' => 'name',
        'multiple' => true,
        'expanded' => true
      ))
      ->add('Enregistrer',      'submit')
    ;

    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,
      function(FormEvent $event) {
        $advert = $event->getData();

        if (null === $advert) {
          return;
        }

        if (!$advert->getPublished() || null === $advert->getId()) {
          $event->getForm()->add('published', 'checkbox', array('required' => false));
        } else {
          $event->getForm()->remove('published');
        }
      }
    );
  }

  /**
   * @param OptionsResolverInterface $resolver
   */
  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'BlogBundle\Entity\Advert'
    ));
  }

  /**
   * @return string
   */
  public function getName()
  {
    return 'blogbundle_advert';
  }
}
