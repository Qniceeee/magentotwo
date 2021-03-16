<?php
namespace Overdose\LessonCron\Cron;

/**
 * Class PutAllUsersToLog
 * @package Overdose\LessonCron\Cron
 */
class PutAllUsersToLog
{
    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    protected $customerRepository;
    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;
    /**
     * @var \Magento\Framework\Serialize\SerializerInterface
     */
    protected $serializer;
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * PutAllUsersToLog constructor.
     * @param \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Serialize\SerializerInterface $serializer
     * @param \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Serialize\SerializerInterface $serializer,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->customerRepository = $customerRepository;
        $this->logger = $logger;
        $this->serializer = $serializer;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @return void|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {

        $searchCriteria = $this->searchCriteriaBuilder
            ->addFilter('entity_id', '100', 'lteq')
            ->create();

        $customers = $this->customerRepository->getList($searchCriteria);

        $result = [];
        foreach ($customers->getItems() as $customer)
        {
            $result [] = [
                'name' =>$customer->getFirstname(),
                'last name' => $customer->getLastname(),
                'email'=> $customer->getEmail()
            ];
        }
        return $this->logger->notice(__('Monitoring:registered customers') . $this->serializer->serialize($result));
    }

}
