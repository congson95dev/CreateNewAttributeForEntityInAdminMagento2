<?php
namespace Jajuma\VendorTableRate\Block\Adminhtml\Vendor\Edit\Tab;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;

class ExportCsv extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'export_vendortablerate.phtml';

    /**
     * @var Registry|null
     */
    protected $_coreRegistry = null;

    /**
     * @var \Magento\Backend\Model\UrlInterface
     */
    protected $backendUrl;

    /**
     * @var \Magento\Authorization\Model\UserContextInterface
     */
    protected $userContext;

    /**
     * @var \Jajuma\Vendor\Model\VendorFactory
     */
    protected $_vendorFatory;

    /**
     * ExportCsv constructor.
     * @param Context $context
     * @param Registry $registry
     * @param \Magento\Backend\Model\UrlInterface $backendUrl
     * @param \Magento\Authorization\Model\UserContextInterface $userContext
     * @param \Jajuma\Vendor\Model\VendorFactory $vendorFactory
     * @param array $data
     */

    public function __construct(
        Context $context,
        Registry $registry,
        \Magento\Backend\Model\UrlInterface $backendUrl,
        \Magento\Authorization\Model\UserContextInterface $userContext,
        \Jajuma\Vendor\Model\VendorFactory $vendorFactory,
        array $data = []
    )
    {
        $this->backendUrl = $backendUrl;
        $this->userContext = $userContext;
        $this->_vendorFatory = $vendorFactory;
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getExportUrl()
    {
        $currentUserId = $this->userContext->getUserId();
        $currentVendor = $this->_coreRegistry->registry('current_vendor');
        $vendorModel = $this->_vendorFatory->create()->loadByUserId($currentUserId);
        if (count($vendorModel->getData()) > 0 ) {
            $vendorId = $vendorModel->getVendorId();
        } elseif ($currentVendor != null && $currentVendor->getVendorId() > 0){
            $vendorId = $currentVendor->getVendorId();
        } else {
            $vendorId = null;
        }
        if ($vendorId){
            $params = ['vendor_id'=>$vendorId];
            $url = $this->backendUrl->getUrl("vendortablerate/system/exportVendorTableRate", $params);
        }else {
            $url = $this->backendUrl->getUrl("vendortablerate/system/exportVendorTableRate");
        }

        return $url;
    }
}