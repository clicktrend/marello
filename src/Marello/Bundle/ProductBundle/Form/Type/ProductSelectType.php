<?php
namespace Marello\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductSelectType extends AbstractType
{
    const NAME = 'marello_product_select';
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'autocomplete_alias' => 'products',
                'create_form_route'  => 'marello_product_create',
                'grid_name' => 'marello-products-grid',
                'create_enabled' => false,
                'configs'            => [
                    'placeholder' => 'marello.product.form.choose_product'
                ],
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return 'oro_entity_create_or_select_inline';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}