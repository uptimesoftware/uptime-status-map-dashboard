<?php
// Include the Smarty header file
require_once("smarty_header.php");
require_once("controller_conf_functions.php");

// display and save the controller info
// format of file:
// key=value
// values to store (9 fields):
// controller_hostname
// controller_username
// controller_password
// controller_port=9997
// controller_ssl=true
// controller_version="v1"
// uptime_ui_hostname
// uptime_ui_ssl=true
// uptime_ui_port

// setup defaults
$message = "";
$options = array();
$options['controller_hostname'] = "localhost";
$options['controller_username'] = "admin";
$options['controller_password'] = "";
$options['controller_port']     = 9997;
$options['controller_ssl']      = true;
$options['controller_version']  = "v1";
$options['uptime_ui_hostname']  = "localhost";
$options['uptime_ui_ssl']       = false;
$options['uptime_ui_port']      = 9999;


// save new values
if (isset($_REQUEST['save'])) {
	if (isset($_REQUEST['controller_hostname'])) { $options['controller_hostname'] = trim($_REQUEST['controller_hostname']); }
	if (isset($_REQUEST['controller_username'])) { $options['controller_username'] = trim($_REQUEST['controller_username']); }
	if (isset($_REQUEST['controller_password'])) { $options['controller_password'] = trim($_REQUEST['controller_password']); }
	if (isset($_REQUEST['controller_port'])) { $options['controller_port'] = intval(trim($_REQUEST['controller_port'])); }
	if (isset($_REQUEST['controller_ssl'])) { $options['controller_ssl'] = true; } else { $options['controller_ssl'] = false; }
	if (isset($_REQUEST['controller_version'])) { $options['controller_version'] = trim($_REQUEST['controller_version']); }
	if (isset($_REQUEST['uptime_ui_hostname'])) { $options['uptime_ui_hostname'] = trim($_REQUEST['uptime_ui_hostname']); }
	if (isset($_REQUEST['uptime_ui_ssl'])) { $options['uptime_ui_ssl'] = true; } else { $options['uptime_ui_ssl'] = false; }
	if (isset($_REQUEST['uptime_ui_port'])) { $options['uptime_ui_port'] = intval(trim($_REQUEST['uptime_ui_port'])); }
	
	// save settings to conf file
	uptimeController::save_controller_info($options);
	
	$message = "Settings saved.";
}
else if (isset($_REQUEST['resetToDefaults'])) {
	// keep defaults, and just save
	uptimeController::save_controller_info($options);
	$message = "Default settings loaded and saved.";
}
else {
	// load settings from conf file
	$options = uptimeController::load_controller_info($options);
}


// Amberjack (Javascript) tour
require_once("tour_text.php");
$tourText = getTourText();


////////////////////////////////////////////////////////////////////////////////////////////
// SMARTY: Assign variables
$smarty->assign( 'controller_hostname', $options['controller_hostname'] );
$smarty->assign( 'controller_username', $options['controller_username'] );
$smarty->assign( 'controller_password', $options['controller_password'] );
$smarty->assign( 'controller_port',     $options['controller_port'] );
$smarty->assign( 'controller_ssl',      $options['controller_ssl'] );
$smarty->assign( 'controller_version',  $options['controller_version'] );
$smarty->assign( 'uptime_ui_hostname',  $options['uptime_ui_hostname'] );
$smarty->assign( 'uptime_ui_ssl',       $options['uptime_ui_ssl'] );
$smarty->assign( 'uptime_ui_port',      $options['uptime_ui_port'] );
$smarty->assign( 'message',             $message );
$smarty->assign( 'tourText', $tourText );
// SMARTY: Display page
$smarty->display('manage_uptime_controller_info.tpl');
?>

