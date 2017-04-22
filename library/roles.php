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
 * Create a new user role with the ability to read, create and edit their own
 * custom content.
 *
 * @return void
 */
function registerNewRole()
{
    /**
     * @see https://codex.wordpress.org/Function_Reference/add_role
     */
    add_role('customrole', 'Custom Role', [
        'read'          => true,
        'edit_posts'    => true,
        'delete_posts'  => false,
        'publish_posts' => true,
        'upload_files'  => true
    ]);

    setRoleCapabilities();
    disableNewUserFeature();
}


/**
 * Set the capabilities according to the type of user.
 *
 * @return void
 */
function setRoleCapabilities()
{
    /**
     * Administrator + Editor (Full Access).
     */
    foreach ([ 'administrator', 'editor' ] as $administrator) {
        $adm = get_role($administrator);
        $adm->add_cap('read');
        $adm->add_cap('read_customrole');
        $adm->add_cap('read_private_customroles');
        $adm->add_cap('edit_customrole');
        $adm->add_cap('edit_customroles');
        $adm->add_cap('edit_others_customroles');
        $adm->add_cap('edit_published_customroles');
        $adm->add_cap('publish_customroles');
        $adm->add_cap('delete_others_customroles');
        $adm->add_cap('delete_private_customroles');
        $adm->add_cap('delete_published_customroles');
    }

    /**
     * Custom User (Limited Access).
     */
    $customrole = get_role('customrole');
    $customrole->add_cap('read');
    $customrole->add_cap('read_customrole');
    $customrole->add_cap('read_private_customroles');
    $customrole->add_cap('edit_customrole');
    $customrole->add_cap('edit_customroles');
    $customrole->add_cap('edit_others_customroles');
    $customrole->add_cap('publish_customroles');
}


/**
 * Disable the AdminBar for the custom User role.
 *
 * @return void
 */
function disableNewUserFeature()
{
    $user = wp_get_current_user();
    if (in_array('customrole', $user->roles)) {
        /**
         * Do not show the adminbar to our custom User.
         */
        show_admin_bar(false);

        /* ... */
    }
}

/* <> */
