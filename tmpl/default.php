<?php

/**
 * @package     VPJoomla.Site
 * @subpackage  mod_vp_accordion
 *
 * @copyright   Copyright (C) 2024 - 2026 VPJoomla. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * Layout variables (provided by Dispatcher):
 *
 * @var  \Joomla\Registry\Registry  $params  Module params
 * @var  \stdClass                  $module  Module record
 * @var  array<int, object>         $items   List of accordion items
 * @var  string                     $domId   Stable DOM id base
 */

\defined('_JEXEC') or die;

if (empty($items)) {
    return;
}

$style         = $params->get('style', 'default') === 'flush' ? ' accordion-flush' : '';
$alwaysOpen    = (int) $params->get('always_open', 0) === 1;
$headingTag    = in_array($params->get('heading_level', 'h2'), ['h2', 'h3', 'h4', 'h5', 'h6'], true)
    ? $params->get('heading_level', 'h2')
    : 'h2';
$parentAttr    = $alwaysOpen ? '' : ' data-bs-parent="#' . $domId . '"';

// Track whether we've already rendered an "open" item — in single-open
// mode we allow only the first one flagged as open to actually be open.
$openConsumed = false;
?>
<div class="vp-accordion accordion<?php echo $style; ?>" id="<?php echo $domId; ?>">
	<?php foreach ($items as $key => $item) :
		$itemId      = $domId . '-item-' . $key;
		$collapseId  = $domId . '-collapse-' . $key;
		$headingId   = $domId . '-heading-' . $key;

		$isOpen = $item->open && (!$openConsumed || $alwaysOpen);

		if ($isOpen && !$alwaysOpen) {
			$openConsumed = true;
		}

		$buttonClasses   = 'accordion-button' . ($isOpen ? '' : ' collapsed');
		$collapseClasses = 'accordion-collapse collapse' . ($isOpen ? ' show' : '');
		$ariaExpanded    = $isOpen ? 'true' : 'false';
	?>
	<div class="accordion-item" id="<?php echo $itemId; ?>">
		<<?php echo $headingTag; ?> class="accordion-header" id="<?php echo $headingId; ?>">
			<button
				class="<?php echo $buttonClasses; ?>"
				type="button"
				data-bs-toggle="collapse"
				data-bs-target="#<?php echo $collapseId; ?>"
				aria-expanded="<?php echo $ariaExpanded; ?>"
				aria-controls="<?php echo $collapseId; ?>"
			>
				<?php echo htmlspecialchars($item->title, ENT_QUOTES, 'UTF-8'); ?>
			</button>
		</<?php echo $headingTag; ?>>
		<div
			id="<?php echo $collapseId; ?>"
			class="<?php echo $collapseClasses; ?>"
			aria-labelledby="<?php echo $headingId; ?>"<?php echo $parentAttr; ?>
		>
			<div class="accordion-body">
				<?php echo $item->text; ?>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
</div>
