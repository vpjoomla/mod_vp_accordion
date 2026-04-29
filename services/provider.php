<?php

/**
 * @package     VPJoomla.Site
 * @subpackage  mod_vp_accordion
 *
 * @copyright   Copyright (C) 2024 - 2026 VPJoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Portions derived from Joomla! CMS (mod_custom).
 * @copyright   (C) 2023 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\Service\Provider\Module;
use Joomla\CMS\Extension\Service\Provider\ModuleDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\HelperFactory;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;

return new class () implements ServiceProviderInterface {
    public function register(Container $container): void
    {
        $container->registerServiceProvider(new ModuleDispatcherFactory('\\VPJoomla\\Module\\Vpaccordion'));
        $container->registerServiceProvider(new HelperFactory('\\VPJoomla\\Module\\Vpaccordion\\Site\\Helper'));
        $container->registerServiceProvider(new Module());
    }
};
