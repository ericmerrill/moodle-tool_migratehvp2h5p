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
 * This tool can upgrade mod_hvp activities, created and maintained by Joubel to the new mod_h5p activity,
 * created by Moodle HQ.
 *
 * The upgrade can be done on any HVP activity instance.
 * The new HP5activity module was introduced in Moodle 3.9 and although it almost reproduces
 * the features of the existing mod_hvp, it wasn't designed to replace it entirely as there
 * are some features than the current mod_h5pactivity doesn't support, such as saving status or H5P hub.
 *
 * This screen is the main entry-point to the plugin, it gives the admin a list
 * of options available to them.
 *
 * @package     tool_migratehvp2h5p
 * @copyright   2020 Sara Arjona <sara@moodle.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$context = context_system::instance();
$url = new moodle_url('/admin/tool/migratehvp2h5p/index.php');

// This calls require_login and checks moodle/site:config.
admin_externalpage_setup('migratehvp2h5p');

$PAGE->set_context($context);
$PAGE->set_url($url);
$PAGE->set_pagelayout('admin');

$PAGE->set_title(get_string('pluginname', 'tool_migratehvp2h5p'));

$renderer = $PAGE->get_renderer('tool_migratehvp2h5p');

echo $renderer->header();
echo $OUTPUT->heading(get_string('hvpactivities', 'tool_migratehvp2h5p'));

// TODO: Implement the logic to call the migrate_hvp2h5p method when required, passing the hvpids to migrate.
// \tool_migratehvp2h5p\api::migrate_hvp2h5p(2); die();

$table = new \tool_migratehvp2h5p\output\hvpactivities_table();
$table->baseurl = $url;
$activitylist = new \tool_migratehvp2h5p\output\listnotmigrated($table);
echo $renderer->render_not_migrated_hvp($activitylist);

// TODO: Review if a list with more actions should be displayed here, instead of displaying directly the HVP activities to migrate.
// For now, activities to migrate are displayed because I'm not sure if more actions will be required.

echo $renderer->footer();
