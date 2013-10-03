<?php

/////////////////////////////////////////////////////////////////////////////
// General information
/////////////////////////////////////////////////////////////////////////////

$app['basename'] = 'pptpd';
$app['version'] = '1.5.5';
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
    'app-network-core >= 1:1.4.5',
    'app-pptpd-plugin-core',
    'app-samba-common-core',
    'app-incoming-firewall-core',
    'csplugin-filewatch',
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
    'filewatch-pptpd-network.conf'=> array('target' => '/etc/clearsync.d/filewatch-pptpd-network.conf'),
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
);

$app['delete_dependency'] = array(
    'app-pptpd-core',
    'app-pptpd-plugin-core',
    'pptpd',
);
