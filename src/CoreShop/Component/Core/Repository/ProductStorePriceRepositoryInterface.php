<?php
/**
 * CoreShop.
 *
 * This source file is subject to the GNU General Public License version 3 (GPLv3)
 * For the full copyright and license information, please view the LICENSE.md and gpl-3.0.txt
 * files that are distributed with this source code.
 *
 * @copyright  Copyright (c) 2015-2020 Dominik Pfaffenbauer (https://www.pfaffenbauer.at)
 * @license    https://www.coreshop.org/license     GNU General Public License version 3 (GPLv3)
 */

declare(strict_types=1);

namespace CoreShop\Component\Core\Repository;

use CoreShop\Component\Core\Model\ProductInterface;
use CoreShop\Component\Core\Model\ProductStorePriceInterface;
use CoreShop\Component\Resource\Repository\RepositoryInterface;
use CoreShop\Component\Store\Model\StoreInterface;

interface ProductStorePriceRepositoryInterface extends RepositoryInterface
{
    /**
     * @param ProductInterface $product
     *
     * @return ProductStorePriceInterface[]
     */
    public function findForProduct(ProductInterface $product): array;

    /**
     * @param ProductInterface $product
     * @param string           $property
     *
     * @return ProductStorePriceInterface[]
     */
    public function findForProductAndProperty(ProductInterface $product, string $property): array;

    /**
     * @param ProductInterface $product
     * @param StoreInterface   $store
     * @param string           $property
     *
     * @return ProductStorePriceInterface[]
     */
    public function findForProductAndStoreAndProperty(ProductInterface $product, StoreInterface $store, string $property): array;
}
