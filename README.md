## Arlo admin tool ##

Admin tool (for now) that synchronises arlo contact employment information.

This plugin was developed separately from the Arlo enrolment plugin because we needed a quick win! Moving forward it would be great
for this to be part of the core enrolment plugin, or it could stay as it is as an extension to the enrol_arlo functionality.

TODO: Implement settings page, make user field configurable. Utilise contact time modified to reduce the amount of un-necessary
DB calls. This will rely on the contact source modified to be updated periodically as part of the enrol_arlo plugin.

## Installing via uploaded ZIP file ##

1. Log in to your Moodle site as an admin and go to _Site administration >
   Plugins > Install plugins_.
2. Upload the ZIP file with the plugin code. You should only be prompted to add
   extra details if your plugin type is not automatically detected.
3. Check the plugin validation report and finish the installation.

## Installing manually ##

The plugin can be also installed by putting the contents of this directory to

    {your/moodle/dirroot}/mod/assign/feedback/verified

Afterwards, log in to your Moodle site as an admin and go to _Site administration >
Notifications_ to complete the installation.

Alternatively, you can run

    $ php admin/cli/upgrade.php

to complete the installation from the command line.

## License ##

2022 Skills Consulting Group.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation,
either version 3 of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this program. If not, see https://www.gnu.org/licenses/.