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
 * Version info for tool_arlo.
 *
 * @package     tool_arlo
 * @author      Donald Barrett <donaldb@skills.org.nz>
 * @copyright   2022 onwards, Skills Consulting Group Ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// No direct access.
defined('MOODLE_INTERNAL') || die();

// This plugin requires Moodle 3.9.
$plugin->requires = 2020061500;

// Plugin details.
$plugin->component = 'tool_arlo';
$plugin->version = 2022061400;
$plugin->release = 'v3.9.0';

// Plugin status details.
$plugin->maturity = MATURITY_ALPHA;

// Other plugin stuff.
$plugin->dependencies = ['enrol_arlo' => 2020073112];