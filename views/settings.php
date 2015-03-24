<?php

/**
 * PPTP server view.
 *
 * @category   apps
 * @package    pptpd
 * @subpackage views
 * @author     ClearFoundation <developer@clearfoundation.com>
 * @copyright  2011 ClearFoundation
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License version 3 or later
 * @link       http://www.clearfoundation.com/docs/developer/apps/pptpd/
 */

///////////////////////////////////////////////////////////////////////////////
//
// This program is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program.  If not, see <http://www.gnu.org/licenses/>.  
//  
///////////////////////////////////////////////////////////////////////////////

///////////////////////////////////////////////////////////////////////////////
// Load dependencies
///////////////////////////////////////////////////////////////////////////////

$this->lang->load('base');
$this->lang->load('pptpd');

///////////////////////////////////////////////////////////////////////////////
// Form handler
///////////////////////////////////////////////////////////////////////////////

if ($auto_configure) {
    $read_only = TRUE;
    $buttons = array();
} else if ($form_type === 'edit') {
    $read_only = FALSE;
    $buttons = array(
        form_submit_update('submit'),
        anchor_cancel('/app/pptpd/settings'),
    );
} else {
    $read_only = TRUE;
    $buttons = array(
        anchor_edit('/app/pptpd/settings/edit')
    );
}

///////////////////////////////////////////////////////////////////////////////
// Auto configure help
///////////////////////////////////////////////////////////////////////////////

$options['buttons'] = array(
    anchor_custom('/app/pptpd/settings/disable_auto_configure', lang('base_disable_auto_configuration'))
);

if ($auto_configure) {
    echo infobox_highlight(
        lang('base_automatic_configuration_enabled'),
        lang('pptpd_auto_configure_help'),
        $options
    );
}

///////////////////////////////////////////////////////////////////////////////
// Form
///////////////////////////////////////////////////////////////////////////////

echo form_open('pptpd/settings');
echo form_header(lang('base_settings'));

echo field_input('local_ip', $local_ip, lang('pptpd_local_ip_range'), $read_only);
echo field_input('remote_ip', $remote_ip, lang('pptpd_remote_ip_range'), $read_only);
echo field_input('dns', $dns, lang('pptpd_dns_server'), $read_only);
echo field_input('wins', $wins, lang('pptpd_wins_server'), $read_only);

echo field_button_set($buttons);

echo form_footer();
echo form_close();
