<?php
/* This function provides automatic linking to an arbitry URL
 * for words from a glossary for which auto-linking is activated.
 * The idea is from Timothy Takemoto, see "Automatic pronounciatin guide"
 * http://moodle.org/mod/forum/discuss.php?d=162387
 *
 * Moodle 1.9 glossary link pattern:
 * /mod/glossary/showentry.php?courseid=1&concept=gorilla
 * Moodle 2.0 glossar link pattern:
 * /mod/glossary/showentry.php?courseid=3&amp;eid=1&amp;displayformat=dictionary
 *
 * <a href="http://localhost/moodle-MOODLE_20_WEEKLY/mod/glossary/showentry.php?courseid=3&amp;eid=1&amp;displayformat=dictionary" 
 * title="Web concepts: JavaScript" 
 * class="glossary autolink glossaryid6">JavaScript</a>
 * Replacement pattern and default URL: http://www.forvo.com/word/{searchterm}#en
 */

function autolinkhijacker_filter($courseid, $text) {

    global $CFG;
    // Derive replacement URL from replacement pattern from settings.
    if (!isset($CFG->filter_autolinkhijacker_url)){
        set_config('filter_autolinkhijacker_url',
            get_string('urldefault', 'filter_autolinkhijacker')
        );
    }

    $replacement_pattern = $CFG->filter_autolinkhijacker_url;

    preg_match_all(
        '/(.+)\{searchterm\}(.*)/i',
        $replacement_pattern,
        $matches
    );

    $url_start  = $matches[1][0];
    $url_end    = $matches[2][0];

    // Replace the target URL of all glossary auto-links.
    $text = preg_replace(
        '/<a.+?href=".+?".+?title=".+?:\s+?(.+?)"[^>]*?>/six',
        "<a href=\"$url_start$1$url_end\" target='_blank' title=\"$url_start$1$url_end\">",
        $text
    );
    return $text;
}