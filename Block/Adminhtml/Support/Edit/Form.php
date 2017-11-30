<?php
/**
 * Shop System Plugins - Terms of Use
 *
 * The plugins offered are provided free of charge by Wirecard Central Eastern Europe GmbH
 * (abbreviated to Wirecard CEE) and are explicitly not part of the Wirecard CEE range of
 * products and services.
 *
 * They have been tested and approved for full functionality in the standard configuration
 * (status on delivery) of the corresponding shop system. They are under General Public
 * License Version 2 (GPLv2) and can be used, developed and passed on to third parties under
 * the same terms.
 *
 * However, Wirecard CEE does not provide any guarantee or accept any liability for any errors
 * occurring when used in an enhanced, customized shop system configuration.
 *
 * Operation in an enhanced, customized configuration is at your own risk and requires a
 * comprehensive test phase by the user of the plugin.
 *
 * Customers use the plugins at their own risk. Wirecard CEE does not guarantee their full
 * functionality neither does Wirecard CEE assume liability for any disadvantages related to
 * the use of the plugins. Additionally, Wirecard CEE does not guarantee the full functionality
 * for customized shop systems or installed plugins of other vendors of plugins within the same
 * shop system.
 *
 * Customers are responsible for testing the plugin's functionality before starting productive
 * operation.
 *
 * By installing the plugin into the shop system the customer agrees to these terms of use.
 * Please do not use the plugin if you do not agree to these terms of use!
 */

namespace Wirecard\ElasticEngine\Block\Adminhtml\Support\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Data\FormFactory;
use Magento\Framework\Registry;

class Form extends Generic implements TabInterface
{

    /**
     * @param Context $context
     * @param Registry $registry
     * @param FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        FormFactory $formFactory,
        array $data = []
    ) {
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create([
                'data' => [
                    'id'     => 'edit_form',
                    'action' => $this->getUrl('*/*/sendrequest', ['id' => $this->getRequest()->getParam('id')]),
                    'method' => 'post'
                ]
            ]
        );

        $form->setUseContainer(true);

        $fieldset = $form->addFieldset('form_form', ['legend' => __('Contact Form')]);
        $fieldset->addField('to', 'select', [
            'label'    => __('To'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'to',
            'options'  => [
                'support.at@wirecard.com' => 'Support Team Wirecard CEE, Austria',
                'support@wirecard.com'    => 'Support Team Wirecard AG, Germany',
                'support.sg@wirecard.com' => 'Support Team Wirecard Singapore'
            ]
        ]);

        $fieldset->addField('replyto', 'text', [
            'label' => __('Your e-mail address'),
            'class' => 'validate-email',
            'name'  => 'replyto'
        ]);

        $fieldset->addField('description', 'textarea', [
            'label'    => __('Your message'),
            'class'    => 'required-entry',
            'required' => true,
            'name'     => 'description',
            'style'    => 'height:30em;width:50em'
        ]);

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return __('Support Request');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return __('Support Request');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
