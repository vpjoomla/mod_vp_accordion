<?php

/**
 * @package     VPJoomla.Site
 * @subpackage  mod_vp_accordion
 *
 * @copyright   Copyright (C) 2024 - 2026 VPJoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace VPJoomla\Module\Vpaccordion\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\Registry\Registry;

/**
 * Helper for mod_vp_accordion.
 *
 * @since  3.0.0
 */
class VpaccordionHelper
{
    /**
     * Build the list of accordion items from module params.
     *
     * Accepts the raw subform value (array of arrays) and returns
     * a numerically-indexed list of items with sane defaults:
     *  - title (string)
     *  - text  (string, optionally content-prepared upstream)
     *  - open  (bool)
     *
     * @param   Registry  $params  Module parameters
     *
     * @return  array<int, object>
     *
     * @since   3.0.0
     */
    public function getItems(Registry $params): array
    {
        $raw = $params->get('accordion');

        if (empty($raw)) {
            return [];
        }

        $items = [];

        foreach ((array) $raw as $row) {
            if (\is_object($row)) {
                $row = (array) $row;
            }

            if (!\is_array($row)) {
                continue;
            }

            $title = isset($row['title']) ? trim((string) $row['title']) : '';
            $text  = isset($row['text']) ? (string) $row['text'] : '';
            $open  = !empty($row['open']);

            if ($title === '' && trim(strip_tags($text)) === '') {
                continue;
            }

            $items[] = (object) [
                'title' => $title,
                'text'  => $text,
                'open'  => $open,
            ];
        }

        // Force only the FIRST item flagged as "open" to actually be open
        // when accordion is in single-open mode (handled in layout).
        return $items;
    }

    /**
     * Build a stable, valid HTML id base from the module id.
     *
     * @param   int  $moduleId  The module id
     *
     * @return  string
     *
     * @since   3.0.0
     */
    public function getDomId(int $moduleId): string
    {
        return 'vp-accordion-' . $moduleId;
    }
}
