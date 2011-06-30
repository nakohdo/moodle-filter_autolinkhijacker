<?php
/*
 * Language file for the Auto-link Hijacker filter.
 * See the following links why the 'filename' doesn't work, and a workaround:
 *  http://tracker.moodle.org/browse/MDL-17684
 * http://docs.moodle.org/dev/Filters#A_note_on_language_strings
 */

$string['filtername']   = 'Auto-link Hijacker';
$string['url']              = 'New target URL';
$string['urldefault']     = 'http://en.wikipedia.org/wiki/{glossaryterm}';
$string['urlconfig']  = 
     'Please enter the new target URL for glossary auto-linking.<p />'
    .'Just insert the <strong>{glossaryterm}</strong> at the appropriate place. <p />'
    .'Other examples: <br />'
    .'http://www.forvo.com/word/{glossaryterm}#en <br />'
    .'http://docs.moodle.org/20/en/{glossaryterm}';
