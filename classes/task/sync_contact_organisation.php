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
 * Task to sync Arlo contact organisation for tool_arlo.
 *
 * @package     tool_arlo
 * @author      Donald Barrett <donaldb@skills.org.nz>
 * @copyright   2022 onwards, Skills Consulting Group Ltd
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_arlo\task;

use coding_exception;
use enrol_arlo\Arlo\AuthAPI\Exception\XMLDeserializerException;
use moodle_exception;
use lang_string;
use core\task\scheduled_task;
use core_user;
use core_text;
use text_progress_trace;

/**
 * Class for sync contact organisation scheduled task.
 */
class sync_contact_organisation extends scheduled_task {
    /**
     * Return a localised name of the task.
     *
     * @return lang_string | string
     * @throws coding_exception
     */
    public function get_name() {
        return get_string('taskname:sync_contact_organisation', 'tool_arlo');
    }

    /**
     * Execute the task.
     */
    public function execute() {
        global $DB, $CFG;
        require_once("{$CFG->dirroot}/user/lib.php");
        $trace = new text_progress_trace();

        // Todo: Use sourcemodified and a setting that stores the last sync and only process contacts modified after that.
        if (enrol_is_enabled('arlo') && $arlousers = $DB->get_records('enrol_arlo_contact')) {
            $arlopluginconfig = new \enrol_arlo\local\config\arlo_plugin_config();
            $arloclient = \enrol_arlo\local\client::get_instance();
            $arlorequesturi = new \enrol_arlo\Arlo\AuthAPI\RequestUri();
            $arlorequesturi->setHost($arlopluginconfig->get('platform'));

            foreach ($arlousers as $arlouser) {
                $arlorequesturi->setResourcePath("contacts/{$arlouser->sourceid}/employment");
                $arlorequesturi->addExpand('Organisation');
                $request = new \GuzzleHttp\Psr7\Request('GET', $arlorequesturi->output(true));
                $response = $arloclient->send_request($request);
                try {
                    $arlocontact = \enrol_arlo\local\response_processor::process($response);
                    if (empty($arlocontact->Organisation->Name) && empty($arlocontact->Organisation->LegalName)) {
                        throw new moodle_exception('httpstatus:204', 'tool_arlo');
                    }
                    $user = core_user::get_user($arlouser->userid);
                    $organisationname = $arlocontact->Organisation->Name ?? $arlocontact->Organisation->LegalName;
                    $a = [
                        'contact' => fullname($user),
                        'organisation' => $organisationname,
                        'field' => 'institution'
                    ];
                    if (core_text::strtolower($user->institution) === core_text::strtolower($organisationname)) {
                        $trace->output(get_string('contactorganisation_nochange', 'tool_arlo', $a));
                        continue;
                    }
                    $user->institution = $organisationname;
                    user_update_user($user, false);
                    $trace->output(get_string('contactorganisation_updated', 'tool_arlo', $a));
                } catch (moodle_exception $exception) {
                    // Ignore. This user must not have an organisation.
                    $user = core_user::get_user($arlouser->id);
                    if ($exception->getMessage() == 'error/httpstatus:404') {
                        $trace->output(get_string('contactorganisation_notfound', 'tool_arlo', fullname($user)));
                    }
                } catch (XMLDeserializerException $exception) {
                    // The root class ContactEmployment does not exist. This will need to be implemented in enrol_arlo.
                    $trace->output($exception->getMessage());
                }
            }
        }
    }
}
