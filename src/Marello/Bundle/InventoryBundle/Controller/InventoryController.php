<?php

namespace Marello\Bundle\InventoryBundle\Controller;

use Marello\Bundle\InventoryBundle\Entity\InventoryItem;
use Marello\Bundle\InventoryBundle\Form\Type\InventoryItemType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Oro\Bundle\SecurityBundle\Annotation as Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Config\Route("/item")
 */
class InventoryController extends Controller
{
    /**
     * @Config\Route("/", name="marello_inventory_inventory_index")
     * @Config\Template
     * @Security\AclAncestor("marello_inventory_inventory_view")
     */
    public function indexAction()
    {
        return [
            'entity_class' => InventoryItem::class,
        ];
    }

    /**
     * @Config\Route("/view/{id}", requirements={"id"="\d+"}, name="marello_inventory_inventory_view")
     * @Config\Template
     * @Security\Acl(
     *      id="marello_inventory_inventory_view",
     *      type="entity",
     *      class="MarelloInventoryBundle:InventoryItem",
     *      permission="VIEW"
     * )
     * @param InventoryItem $inventoryItem
     *
     * @return array
     */
    public function viewAction(InventoryItem $inventoryItem)
    {
        return [
            'entity' => $inventoryItem,
            'product' => $inventoryItem->getProduct()
        ];
    }

    /**
     * @Config\Route("/update/{id}", requirements={"id"="\d+"}, name="marello_inventory_inventory_update")
     * @Config\Template
     * @Security\Acl(
     *      id="marello_inventory_inventory_update",
     *      type="entity",
     *      class="MarelloInventoryBundle:InventoryItem",
     *      permission="EDIT"
     * )
     * @param InventoryItem $inventoryItem
     * @param Request $request
     *
     * @return array|RedirectResponse
     */
    public function updateAction(InventoryItem $inventoryItem, Request $request)
    {
        return $this->get('oro_form.update_handler')->update(
            $inventoryItem,
            $this->createForm(InventoryItemType::class, $inventoryItem),
            $this->get('translator')->trans('marello.inventory.messages.success.inventoryitem.saved'),
            $request
        );
    }


    /**
     * @Config\Route("/widget/info/{id}", name="marello_inventory_widget_info", requirements={"id"="\d+"})
     * @Config\Template("MarelloInventoryBundle:Inventory/widget:info.html.twig")
     *
     * @param InventoryItem $inventoryItem
     *
     * @return array
     */
    public function infoAction(InventoryItem $inventoryItem)
    {
        return [
            'item' => $inventoryItem,
            'product' => $inventoryItem->getProduct()
        ];
    }

    /**
     * @Config\Route("/widget/datagrid/{id}", name="marello_inventory_widget_datagrid", requirements={"id"="\d+"})
     * @Config\Template("MarelloInventoryBundle:Inventory/widget:datagrid.html.twig")
     *
     * @param InventoryItem $inventoryItem
     *
     * @return array
     */
    public function datagridAction(InventoryItem $inventoryItem)
    {
        return [
            'item' => $inventoryItem,
        ];
    }
}
