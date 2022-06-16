<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * English language strings for Arlo admin tool.
 *
 * @package     tool_arlo
 * @author      Donald Barrett <donaldb@skills.org.nz>
 * @copyright   2022 onwards, Skills Consulting Group Ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// No direct access.
defined('MOODLE_INTERNAL') || die();

// Default langstring.
$string['pluginname'] = 'Arlo admin tool';
$string['privacy:metadata:core_user'] = 'The Arlo admin tool stores the name of a Contact\'s organisation to the core user \'institution\' field';
$string['taskname:sync_contact_organisation'] = 'Sync Arlo contact organisation';
$string['httpstatus:204'] = 'No Content';
$string['contactorganisation_updated'] = 'Contact \'{$a->contact}\' organisation set to \'{$a->organisation}\' using the moodle user field \'{$a->field}\'';
$string['contactorganisation_nochange'] = 'No change in contact \'{$a->contact}\' organisation \'{$a->organisation}\' in the moodle user field \'{$a->field}\'';
$string['contactorganisation_notfound'] = 'Contact {$a} does not have any employment details in Arlo.';
