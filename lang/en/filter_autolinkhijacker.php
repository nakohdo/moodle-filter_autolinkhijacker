<?php
/*
 * Language file for the Autolink Hijacker filter.
 * See the following links why the 'filename' doesn't work, and a workaround:
 *  http://tracker.moodle.org/browse/MDL-17684
 * http://docs.moodle.org/dev/Filters#A_note_on_language_strings
 */

$string['filtername'] = 'Auto-link Hijacker';
$string['url']        = 'Target URL';
$string['urldefault'] = 'http://www.forvo.com/word/{searchterm}#en';
$string['urlconfig']  = 
     'Please enter the new target URL for glossary auto-linking.<p />'
    .'Just insert the <strong>{searchterm}</strong> at the appropriate place. <p />'
    .'Other examples: <br />'
    .'http://en.wikipedia.org/wiki/{searchterm}<br />'
    .'http://docs.moodle.org/20/en/{searchterm}';
