<?php
namespace Overdose\Brands\Block\Adminhtml\Edit\Form;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;


/**
 * Class BackButton
 * @package Overdose\Brands\Block\Adminhtml\Edit\Form
 */
class BackButton  extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData(): array {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getUrlBuilder()->getUrl('*/*/index')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

}