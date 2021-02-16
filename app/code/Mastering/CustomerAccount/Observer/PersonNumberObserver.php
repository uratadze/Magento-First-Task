<?php


namespace Mastering\CustomerAccount\Observer;



use Magento\Framework\Event\ObserverInterface;

use Magento\Customer\Api\CustomerRepositoryInterface;

class PersonNumberObserver implements ObserverInterface

{

    protected $customerRepository;

    public function __construct(

        CustomerRepositoryInterface $customerRepository)

    {

        $this->customerRepository = $customerRepository;

    }

    public function execute(\Magento\Framework\Event\Observer $observer)

    {

//        $customer = $observer->getEvent()->getCustomer();

//        $customer->setCustomAttribute('person_number', '1234567890');
//        $customer->setData('person_number', '123456777');

//        $this->customerRepository->save($customer);

        return $this;

    }

}
