uptime-status-map-dashboard
===========================
Drag & drop elements onto a world map view (or other images) to create a fully custom (and awesome) up.time dashboard!

Requirements
----------------
* Browser with full SVG support (Chrome, IE9+, Opera) (Firefox currently has an issue dragging elements on an SVG canvas)
* JQuery [http://jquery.com]
* QTip2 [http://craigsworks.com/projects/qtip2/]
* Smarty [PHP template engine] [http://www.smarty.net/]
* PHP libCURL [PHP 5.4.3 (Thread Safe)] [http://www.anindya.com/php-5-4-3-and-php-5-3-13-x64-64-bit-for-windows/]
	* Direct link: [http://www.mediafire.com/file/onpvka3h1gymwa6/php-5.4.3-Win32-VC9-x64.zip]
* up.time Controller (API) [http://support.uptimesoftware.com]


If running on the up.time Monitoring Station (which already includes Apache+PHP with the necessary modules), simply edit the up.time php.ini file (uptime_dir/apache/php/php.ini) and uncomment the following lines:
* extension=php_curl.dll
You will still have to download the latest version of libCURL (link above) and place it in the "[uptime_dir]/apache/php/ext/" directory.

Setup
=================
* Install the up.time Controller (API) on the same system
* Download and extract this project (uptime-status-map-dashboard) into a "/world_map" sub-directory in "[uptime_dir]/GUI/". The files should be placed in: "[uptime_dir]/GUI/world_map". We can then access the UI with the link: "http://[uptime_dir]/world_map"
* In the "world_map" directory there are two ".js" files that we need to edit to make this work:
	* /js/uptime.mapEditor.js
	* /js/uptime.viewDashboard.js
	* Edit both files and insert the correct values for the following:

Setup global variables:

	var uptime_host = 'localhost';
	var uptime_user = 'admin';
	var uptime_pass = 'admin';
	var uptime_port = 9997;
	var uptime_ver = 'v1';
	var uptime_ssl = true;
	var uptime_ui_url = "https://" + uptime_host + ":9999";

* Now we can access the interface by navigating to: http://[uptime_dir]/world_map
* It will also be easier to access if we can add the dashboard and management interface to the up.time UI with the steps below.


Adding the Dashboard to a Custom Tab under "My Portal"
------------------------------------------------------
* Click on the "Config" tab at the top, and then click on "up.time Configuration"
* Enter the following to add a custom tab to My Portal:

	myportal.custom.tab1.enabled=true
	myportal.custom.tab1.name=Manage Status Maps
	myportal.custom.tab1.URL=/world_map/


Adding a Map Dashboard to the Custom Tab under "GlobalScan"
-----------------------------------------------------------
Once you create a dashboard, you can copy the URL and put it on GlobalScan for everyone to view. To add a custom tab to the up.time GlobalScan view:
* Click on the "Config" tab at the top, and then click on "up.time Configuration"
* Enter the following:

	globalscan.custom.tab.enabled=true
	globalscan.custom.tab.name=World Dashboard
	globalscan.custom.tab.URL=/world_map/view_dashboards.php?d=[DASHBOARD_NAME]



Sample Screenshot
-----------------
<img src="https://raw.github.com/uptimesoftware/uptime-status-map-dashboard/master/screenshots/world-dashboard.png" width="500px" height="350px">