<?php

namespace Drupal\premios;

use Drupal\commerce_product\Entity\ProductInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\mi_monedero\MonederoManager;
use Drupal\premios\Mail\MailPremios;

/**
 * Premios manager class.
 */
class PremiosManager
{
    /**
     * The entity type manager.
     *
     * @var \Drupal\Core\Entity\EntityTypeManagerInterface
     */
    protected $entityTypeManager;

    /**
     * The Monedero manager.
     *
     * @var Drupal\mi_monedero\MonederoManager
     */
    protected $monederoManager;

    /**
     * The premios mail.
     *
     * @var \Drupal\premios\Mail\MailPremios
     */
    protected $mailPremios;

    /**
     * Constructs a new Premios Manager Object.
     *
     * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
     *   The entity type manager.
     * @param Drupal\mi_monedero\MonederoManager $monederoManager
     *   The monedero manager.
     * @param \Drupal\premios\Mail\MailPremios $mailPremios
     *   The premios mail manager.
     */

    public function __construct(EntityTypeManagerInterface $entity_type_manager, MonederoManager $monederoManager, MailPremios $mailPremios)
    {
        $this->entityTypeManager = $entity_type_manager;
        $this->monederoManager = $monederoManager;
        $this->mailPremios = $mailPremios;
    }

    /**
     * Busca todas las lineas de pedidos que tienen este producto y les paga el premio en el monedero del usuario propiertario del pedido
     */
    public function payPremiosProduct(ProductInterface $product, $premio)
    {
        $product_variation = reset($product->getVariations());

        if ($product_variation) {
            $order_item_storage = $this->entityTypeManager->getStorage('commerce_order_item');
            $query = $order_item_storage->getQuery()->condition('purchased_entity', $product_variation->id());
            $id = $query->execute();

            if ($id) { // si hay algun pedido que tiene ese producto, pagamos, sino no hacemos nada

                $commerce_order_item = $order_item_storage->load((int)key($id));
                $commerce_order = $commerce_order_item->getOrder();
                // si ya esta pagado no hacemos nada

                if ($commerce_order_item->get('field_premio_pagado')->value == "0") {

                    $quantity = (int)$commerce_order_item->getQuantity();
                    $reward = $quantity * $premio;
                    $account = $commerce_order->getCustomer();
                    $this->monederoManager->masMonedero($account, $reward); // pay de price
                    $orderes = $this->entityTypeManager->getStorage('commerce_order')->load($commerce_order->id());
                    $orderes->set('field_pago_premio_pedido', 3); // Mi Monedero
                    $orderes->save();

                    $commerce_order_item->set('field_premio_pagado', 1);
                    $commerce_order_item->save();

                    $this->mailPremios->send($commerce_order_item, $reward);
                }
            }
        }
    }
}
