Up.time Status Map Dashboard
===========================
Drag & drop elements onto a world map view (or other images) to create a fully custom (and awesome) up.time dashboard!


Requirements
----------------
* Browser with full SVG support (Chrome, IE9+, Opera) (Firefox currently has an issue dragging elements on an SVG canvas)
* up.time Controller (API) [http://support.uptimesoftware.com]


Setup
=================
1. Install this plugin (which you did already)

2. Install the up.time Controller (API) on the same system

3. Login to up.time and click on Config > up.time Configuration

4. Place the following text to create a custom tab under "My Portal" which will allow you to create and manage your status map dashboards:

myportal.custom.tab2.enabled=true
myportal.custom.tab2.name=Status Map Dashboards
myportal.custom.tab2.URL=/world_map/


Linux Monitoring Station
=================

If you're installing this on a Linux Monitoring Station there are some extra steps required.
PHP libCURL must be loaded properly with Apache/PHP.
Make sure to link the necessary libCURL libraries to the "php" binary.

You can find out which libraries are necessary by running:
> ldd /usr/local/uptime/apache/bin/php
