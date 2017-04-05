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
 *
 * - - - - -
 *
 * Plugin Name: &#9733; Slate
 * Plugin URI:  https://github.com/jasondmoss/wpplugin-slate/
 * Description: Starter plug-in for personal projects.
 * Version:     0.1.0
 * Author:      Jason D. Moss <jason@jdmlabs.com>
 * Author URI:  https://www.jdmlabs.com/
 * License:     WTFPL License
 * License URI: https://raw.githubusercontent.com/jasondmoss/wpplugin-slate/master/LICENSE.md
 * Text Domain: slate
 * Domain Path: /assets/language
 */

defined('ABSPATH') || die('No Direct Access');


/**
 * Check/Confirm minimum PHP version.
 */
if (version_compare(PHP_VERSION, '5.6.30', '<')) {
    die('"Slate" requires at least PHP 5.6.30. Your installed version is '. PHP_VERSION);
}


/* -- */


/**
 * Library functions.
 *
 * Recursively loads all required function files.
 *
 * @see http://php.net/manual/en/function.glob.php
 */
foreach (glob(__DIR__ .'/library/*{*,/*}.php', GLOB_BRACE) as $libraryFile) {
    require_once $libraryFile;
}

/**
 *
 */
foreach ([ 'Label1' ] as $cpt) {
    /**
     * Register custom post type.
     */
    if (function_exists("registerPt{$cpt}")) {
        add_action('init', "registerPt{$cpt}");
    }

    /**
     * Register custom taxonom(y|ies).
     */
    if (function_exists("registerTx{$cpt}")) {
        add_action('init', "registerTx{$cpt}");
    }

    /**
     * Edit custom post type title placeholder.
     */
    if (function_exists("customEdit{$cpt}Title")) {
        add_filter('enter_title_here', "customEdit{$cpt}Title");
    }

    /**
     * rename custom post type image metabox.
     */
    if (function_exists("rename{$cpt}ImageMetabox")) {
        add_action('add_meta_boxes', "rename{$cpt}ImageMetabox");
    }

    /**
     * Register custom ACF Field Groups.
     */
    if (function_exists("register{$cpt}AcfCustomFields")) {
        add_action('acf/init', "register{$cpt}AcfCustomFields");
    }
}

/**
 * Create a new user role with the our custom capabilities.
 */
if (function_exists('registerNewRole')) {
    add_action('after_setup_theme', 'registerNewRole');
}

/**
 * Register Rest API hooks and endpoints.
 */
if (function_exists('registerSlateApi')) {
    add_action('rest_api_init', 'registerSlateApi');
}

/**
 * Register our assets.
 */
if (function_exists('registerSlateAssets')) {
    add_action('admin_enqueue_scripts', 'registerSlateAssets');
}

/* <> */
