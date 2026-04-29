# VP Accordion

A lightweight Joomla module that creates clean, accessible accordion sections
using native Bootstrap 5 markup. Ideal for FAQs, documentation snippets,
pricing details and any content that benefits from being collapsed by default.

## Features

- Native Bootstrap 5 accordion markup — no custom JavaScript
- Two visual styles: default (boxed) and flush (no outer borders)
- Single-open mode or "allow multiple open"
- Per-item "open by default" toggle
- Configurable semantic heading level (H2 – H6)
- Optional content plugins processing (smart tags, shortcodes, etc.)
- Optional loading of Joomla's bundled Bootstrap collapse JS / Bootstrap CSS,
  so it does not duplicate assets when the site template already provides them
- Available in English and Russian out of the box

## Requirements

- Joomla 5.0+ or 6.0+
- PHP 8.1+
- A site template that includes Bootstrap 5 styles (most modern Joomla
  templates do; if not, enable "Load Bootstrap CSS" in the module settings)

## Installation

1. Download the latest release ZIP from
   https://vpjoomla.com/extensions/free/vp-accordion
2. In the Joomla administrator, go to **System → Install → Extensions**
3. Drop the ZIP onto the upload area
4. Go to **Content → Site Modules**, create a new instance of "VP Accordion",
   add your items, choose a position and publish

## Usage

Each module instance contains a list of items. For every item you set:

- a **Title** — the visible button text
- a **Content** body — HTML, edited via Joomla's WYSIWYG editor
- an **Open by default** flag

The **Display** tab controls the visual style, single-open vs. multi-open
behaviour, and the heading level used for accessibility.

The **Assets** tab lets you opt out of loading Bootstrap's collapse JS and CSS
when your template already includes them.

## License

Released under the GNU General Public License v2.0 or later. See `LICENSE.txt`.

This module includes code derived from the Joomla! CMS (mod_custom),
Copyright (C) Open Source Matters, Inc., licensed under GPL v2 or later.

## Author

Volodymyr Pershyn — VPJoomla — https://vpjoomla.com
