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
 * Filter redirecting auto-linked glossary entries to an arbitray URL.
 *
 * @package    filter
 * @subpackage autolinkhijacker
 * @copyright  2011 onwards Frank Ralf {@link webmaster@nakohdo.de}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class filter_autolinkhijacker extends moodle_text_filter {

    public function filter($text, array $options = array()) {

    global $CFG;
    // Derive replacement URL from replacement pattern from settings.
    if (!isset($CFG->filter_autolinkhijacker_url)){
        set_config('filter_autolinkhijacker_url',
            get_string('urldefault', 'filter_autolinkhijacker')
        );
    }

    $replacement_pattern = $CFG->filter_autolinkhijacker_url;

    preg_match(
        '/(.+)\{glossaryterm\}(.*)/i',
        $replacement_pattern,
        $urlparts
    );

    $urlstart  = $urlparts[1];
    $urlend    = $urlparts[2];

    // Replace the target URL of all glossary auto-links.
    $regex = '/
        <a
        .+?
        href=".+?"
        .+?
        title=".+?:\s+?(.+?)"
        [^>]*?
        >
        /six';

    $text = preg_replace(
        $regex,
        "<a href=\"$urlstart$1$urlend\" target='_blank' title=\"$urlstart$1$urlend\">",
        $text
    );
    return $text;
    }
}