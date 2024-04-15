<?php

declare(strict_types=1);

namespace Impact\Campaign\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Setup\EavSetupFactory;

class InstallCampaignAttribute implements DataPatchInterface, PatchRevertableInterface
{
    public const ATTRIBUTE_CODE = 'campaign';

    public const ATTRIBUTE_LABEL = 'Campaign Attribute';

    private ModuleDataSetupInterface $moduleDataSetup;

    private EavSetupFactory $eavSetupFactory;

    /**
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        EavSetupFactory          $eavSetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /** @inheritdoc */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->addAttribute(
            Product::ENTITY,
            self::ATTRIBUTE_CODE,
            [
                'group' => 'General',
                'type' => 'text',
                'label' => self::ATTRIBUTE_LABEL,
                'input' => 'text',
                'required' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'user_defined' => true,
                'global' => ScopedAttributeInterface::SCOPE_STORE,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
                'is_searchable_in_grid' => false,
                'visible' => false,
                'backend' => '',
                'frontend' => '',
                'source' => '',
            ]
        );

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public function revert(): void
    {
        $this->moduleDataSetup->getConnection()->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(Product::ENTITY, self::ATTRIBUTE_CODE);

        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /** {@inheritDoc} */
    public static function getDependencies(): array
    {
        return [];
    }

    /** {@inheritDoc} */
    public function getAliases(): array
    {
        return [];
    }
}
