<?php
/**
 * 2007-2017 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2017 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 */

/**
 * Class EntityMetaDataRetriever
 *
 * @since 1.0.0
 */
class EntityMetaDataRetrieverCore
{
    /**
     * @param string $className
     *
     * @return EntityMetaData
     * @throws PrestaShopException
     *
     * @since 1.1.0
     */
    public function getEntityMetaData($className)
    {
        $metaData = new EntityMetaData();

        $metaData->setEntityClassName($className);

        if (property_exists($className, 'definition')) {
            // Legacy entity
            $classVars = get_class_vars($className);
            $metaData->setTableName($classVars['definition']['table']);
            $metaData->setPrimaryKeyFieldNames(array($classVars['definition']['primary']));
        } else {
            throw new PrestaShopException(
                sprintf(
                    'Cannot get metadata for entity `%s`.',
                    $className
                )
            );
        }

        return $metaData;
    }
}
