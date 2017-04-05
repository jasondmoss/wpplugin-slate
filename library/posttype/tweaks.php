<?php

/**
 * Slate.
 *
 * @package    WordPress
 * @subpackage Plugin|Slate
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/wpplugin-slate/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/wpplugin-slate/
 */


/**
 * Rename the "Featured Image" metabox to better indicate the post type image.
 *
 * @global $wp_meta_boxes
 *
 * @return void
 */
function renameVendorImageMetabox()
{
    global $wp_meta_boxes;

    $wp_meta_boxes['custom_posttype']['side']['low']['postimagediv']['title'] = __('Custom PostType Image', 'slate');
}


/**
 * Replace the edit screen title placeholder with something more apporpriate to
 * our custom post type.
 *
 * @param string $input
 *
 * @return string
 */
function customEditVendorTitle($input)
{
    if ('custom_posttype' === get_post_type()) {
        return __('Enter Custom PostType name here', 'slate');
    }

    return $input;
}

/* <> */
