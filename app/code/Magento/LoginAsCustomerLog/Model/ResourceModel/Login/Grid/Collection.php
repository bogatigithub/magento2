<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\LoginAsCustomerLog\Model\ResourceModel\Login\Grid;

/**
 * LoginAsCustomerLog collection
 */
class Collection extends \Magento\LoginAsCustomerLog\Model\ResourceModel\Login\Collection
{
    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_map['fields']['email'] = 'c.email';
    }

    /**
     * Init collection select
     *
     * @return $this
     */
    protected function _initSelect(): self
    {
        parent::_initSelect();
        $this->getSelect()
            ->joinLeft(
                ['c' => $this->getTable('customer_entity')],
                'c.entity_id = main_table.customer_id',
                ['email']
            )->joinLeft(
                ['a' => $this->getTable('admin_user')],
                'a.user_id = main_table.admin_id',
                ['username']
            );
        return $this;
    }
}
