<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'pptpd';
$app['version'] = '1.6.5';
$app['release'] = '1';
$app['vendor'] = 'ClearFoundation';
$app['packager'] = 'ClearFoundation';
$app['license'] = 'GPLv3';
$app['license_core'] = 'LGPLv3';
$app['description'] = lang('pptpd_app_description');

/////////////////////////////////////////////////////////////////////////////
// App name and categories
/////////////////////////////////////////////////////////////////////////////

$app['name'] = lang('pptpd_app_name');
$app['category'] = lang('base_category_network');
$app['subcategory'] = lang('base_subcategory_vpn');

/////////////////////////////////////////////////////////////////////////////
// Controllers
/////////////////////////////////////////////////////////////////////////////

$app['controllers']['pptpd']['title'] = $app['name'];
$app['controllers']['settings']['title'] = lang('base_settings');
$app['controllers']['policy']['title'] = lang('base_app_policy');

/////////////////////////////////////////////////////////////////////////////
// Packaging
/////////////////////////////////////////////////////////////////////////////

$app['requires'] = array(
    'app-accounts',
    'app-incoming-firewall',
    'app-groups',
    'app-users',
    'app-network',
);

$app['core_requires'] = array(
    'app-events-core',
    'app-network-core >= 1:1.4.5',
    'app-pptpd-plugin-core',
    'app-samba-common-core',
    'pptpd >= 1.3.4',
    'ppp >= 2.4.5-5.v6',
    'system-windows-driver',
);

$app['core_directory_manifest'] = array(
    '/etc/clearos/pptpd.d' => array(),
    '/var/clearos/pptpd' => array(),
    '/var/clearos/pptpd/backup' => array(),
);

$app['core_file_manifest'] = array(
    'pptpd.php'=> array('target' => '/var/clearos/base/daemon/pptpd.php'),
    'authorize' => array(
        'target' => '/etc/clearos/pptpd.d/authorize',
        'mode' => '0644',
        'owner' => 'root',
        'group' => 'root',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
    'pptpd.conf' => array(
        'target' => '/etc/clearos/pptpd.conf',
        'mode' => '0644',
        'owner' => 'root',
        'group' => 'root',
        'config' => TRUE,
        'config_params' => 'noreplace',
    ),
    'network-configuration-event'=> array(
        'target' => '/var/clearos/events/network_configuration/pptpd',
        'mode' => '0755'
    ),
    'network-peerdns-event'=> array(
        'target' => '/var/clearos/events/network_peerdns/pptpd',
        'mode' => '0755'
    ),
    'samba-configuration-event'=> array(
        'target' => '/var/clearos/events/samba_configuration/pptpd',
        'mode' => '0755'
    ),
);

$app['delete_dependency'] = array(
    'app-pptpd-core',
    'app-pptpd-plugin-core',
    'pptpd',
);
