<?php
/* This function provides automatic linking to an arbitry URL
 * for words from a glossary for which auto-linking is activated.
 * The idea is from Timothy Takemoto, see "Automatic pronounciatin guide"
 * http://moodle.org/mod/forum/discuss.php?d=162387
 *
 * Moodle glossary link pattern:
 * /moodle/mod/glossary/showentry.php?courseid=1&concept=gorilla
 *
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

    preg_match_all (
        '/(.+)\{glossaryterm\}(.*)/i',
        $replacement_pattern,
        $matches
    );

    $url_start  = $matches[1][0];
    $url_end    = $matches[2][0];

    // Replace the target URL of all glossary auto-links.
    
    $regex = '/
        <a
        .+?
        class="(?P<class>[^"]*)"
        .+?
        title="([^"]*)"
        .+?
        href="(.+?concept=(.+?))"
        >
        /six';
    
    $text = preg_replace (
        $regex,
        "<a href=\"$url_start$4$url_end\" target='_blank' title='$2'>",
        $text
    );
    return $text;
}