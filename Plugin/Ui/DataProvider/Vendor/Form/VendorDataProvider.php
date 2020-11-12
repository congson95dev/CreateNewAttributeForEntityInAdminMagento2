<?php
namespace Jajuma\VendorTableRate\Plugin\Ui\DataProvider\Vendor\Form;

use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\App\Request\Http;

class VendorDataProvider
{
    const CONTAINER_PREFIX = 'container_';
    /**
     * @var ArrayManager
     */
    protected $arrayManager;

    /**
     * @var Http
     */
    protected $request;

    /**
     * @var \Jajuma\VendorTableRate\Block\Adminhtml\Vendor\Edit\Tab\ExportCsv
     */
    protected $_exportCsv;

    /**
     * VendorDataProvider constructor.
     */
    public function __construct(
        ArrayManager $arrayManager,
        Http $request,
        \Jajuma\VendorTableRate\Block\Adminhtml\Vendor\Edit\Tab\ExportCsv $exportCsv,
        \Jajuma\VendorTableRate\Block\Adminhtml\Vendor\Edit\Tab\VendorShippingMethods $vendorShippingMethods
    ) {
        $this->arrayManager = $arrayManager;
        $this->request = $request;
        $this->_exportCsv = $exportCsv;
        $this->vendorShippingMethods = $vendorShippingMethods;
    }
    public function afterGetMeta(\Jajuma\Vendor\Ui\DataProvider\Vendor\Form\VendorDataProvider $subject, $meta)
    {
        if (isset($meta['shipping'])) {
            $meta['shipping']['children']['vendor_tablerate']['arguments'] = $meta['shipping']['arguments'];
            $meta['shipping']['children']['vendor_tablerate']['arguments']['data']['config']['label'] = __('Vendor Table Rate');
            $meta['shipping']['children']['vendor_tablerate']['children']['export_csv']['arguments']['data']['config'] = [
                "component" => "Jajuma_VendorTableRate/js/components/export-csv",
                'componentType' => 'field',
                'formElement' => 'input',
                'label' => __('Export'),
                'exportHtml' => $this->_exportCsv->toHtml(),
                'customStyles' => 'display : block',
                'source' => 'shipping'
            ];
        }

        return $meta;
    }
}