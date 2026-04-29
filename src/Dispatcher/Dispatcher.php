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

namespace VPJoomla\Module\Vpaccordion\Site\Dispatcher;

\defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\HelperFactoryAwareInterface;
use Joomla\CMS\Helper\HelperFactoryAwareTrait;
use Joomla\CMS\HTML\HTMLHelper;

/**
 * Dispatcher class for mod_vp_accordion.
 *
 * @since  3.0.0
 */
class Dispatcher extends AbstractModuleDispatcher implements HelperFactoryAwareInterface
{
    use HelperFactoryAwareTrait;

    /**
     * Returns the layout data.
     *
     * @return  array
     *
     * @since   3.0.0
     */
    protected function getLayoutData(): array
    {
        $data = parent::getLayoutData();

        /** @var \Joomla\Registry\Registry $params */
        $params = $data['params'];

        // Optionally let plugins process the body of every item
        // (smart tags, shortcode plugins, etc.) before we render.
        if ((int) $params->get('prepare_content', 1) === 1) {
            $accordion = (array) $params->get('accordion');

            foreach ($accordion as $key => $row) {
                $row = (array) $row;

                if (isset($row['text']) && $row['text'] !== '') {
                    $row['text'] = HTMLHelper::_(
                        'content.prepare',
                        $row['text'],
                        '',
                        'mod_vp_accordion.content'
                    );
                }

                $accordion[$key] = $row;
            }

            $params->set('accordion', $accordion);
        }

        // Build the items collection through the Helper so the layout
        // gets clean, predictable objects.
        $helper = $this->getHelperFactory()->getHelper('VpaccordionHelper');

        $data['items']    = $helper->getItems($params);
        $data['domId']    = $helper->getDomId((int) $data['module']->id);

        // Conditionally load Bootstrap assets via WebAssetManager.
        $this->loadBootstrapAssets($params);

        return $data;
    }

    /**
     * Load Bootstrap JS / CSS through Joomla's WebAssetManager when
     * the user has not opted out (e.g. when the site template already
     * provides them).
     *
     * @param   \Joomla\Registry\Registry  $params  Module parameters
     *
     * @return  void
     *
     * @since   3.0.0
     */
    private function loadBootstrapAssets($params): void
    {
        $document = Factory::getApplication()->getDocument();

        if (!method_exists($document, 'getWebAssetManager')) {
            return;
        }

        $wa = $document->getWebAssetManager();

        if ((int) $params->get('load_bootstrap_js', 1) === 1
            && $wa->assetExists('script', 'bootstrap.collapse')
        ) {
            $wa->useScript('bootstrap.collapse');
        }

        if ((int) $params->get('load_bootstrap_css', 0) === 1
            && $wa->assetExists('style', 'bootstrap.css')
        ) {
            $wa->useStyle('bootstrap.css');
        }
    }
}
