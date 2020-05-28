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

namespace CoreShop\Bundle\ShippingBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ShippingPriceCalculatorsPass implements CompilerPassInterface
{
    public const SHIPPING_PRICE_CALCULATOR_TAG = 'coreshop.shipping.price_calculator';

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has('coreshop.registry.shipping.price_calculators')) {
            return;
        }

        $registry = $container->getDefinition('coreshop.registry.shipping.price_calculators');

        $map = [];
        foreach ($container->findTaggedServiceIds(self::SHIPPING_PRICE_CALCULATOR_TAG) as $id => $attributes) {
            if (!isset($attributes[0]['priority']) || !isset($attributes[0]['type'])) {
                throw new \InvalidArgumentException('Tagged PriceCalculator `' . $id . '` needs to have `priority`, `type` attributes.');
            }

            $map[$attributes[0]['type']] = $attributes[0]['type'];
            $registry->addMethodCall('register', [$attributes[0]['type'], $attributes[0]['priority'], new Reference($id)]);
        }

        $container->setParameter('coreshop.shipping.price_calculators', $map);
    }
}
