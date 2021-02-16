<?php


namespace Mastering\CustomerAccount\Setup;

use Magento\Customer\Api\CustomerMetadataInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;

class InstallData implements InstallDataInterface
{
    /**
     * Customer setup factory
     *
     * @var \Magento\Customer\Setup\CustomerSetupFactory
     */
    private $customerSetupFactory;

    /**
     * Init
     *
     * @param \Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory
     */
    public function __construct(\Magento\Customer\Setup\CustomerSetupFactory $customerSetupFactory) {
    $this->customerSetupFactory = $customerSetupFactory;
}


    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
{
    $setup->startSetup();

    /** @var CustomerSetup $customerSetup */
    $customerSetup = $this->customerSetupFactory->create(['setup' => $setup]);


    $customerSetup->addAttribute(
        \Magento\Customer\Model\Customer::ENTITY,
        'person_number',
        [
            'type' => 'varchar',
            'label' => 'Person Number',
            'input' => 'text',
            'required' => true,
            'system' => false,
            'position' => 100,
            'visible' => true,
            'user_defined' => true
        ]
    );

    $customerSetup->updateAttribute('customer', 'person_number', 'is_used_for_customer_segment', '1');

    $forms = ['adminhtml_customer', 'checkout_register', 'customer_account_create', 'customer_account_edit'];

    $attribute = $customerSetup->getEavConfig()->getAttribute('customer', 'person_number');
    $attribute->setData('used_in_forms', ['adminhtml_customer']);
    $attribute->addData([
        'attribute_set_id' => 1,
        'attribute_group_id' => 1
    ]);
    $attribute->save();
    $setup->endSetup();
}
}

