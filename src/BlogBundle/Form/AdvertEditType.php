<?php


namespace BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class AdvertEditType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->remove('date');
  }

  public function getName()
  {
    return 'blogbundle_advert_edit';
  }

  public function getParent()
  {
    return new AdvertType();
  }
}
