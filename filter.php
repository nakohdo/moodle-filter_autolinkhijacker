<?php
/* This function provides automatic linking to an arbitry URL
 * for words from a glossary for which auto-linking is activated.
 * The idea is from Timothy Takemoto, see "Automatic pronounciatin guide"
 * http://moodle.org/mod/forum/discuss.php?d=162387
 *
 * Moodle 1.9 glossary link pattern:
 * /moodle/mod/glossary/showentry.php?courseid=1&concept=gorilla
 *
 * Replacement pattern and default URL: http://en.wikipedia.org/wiki/{glossaryterm}
 */

function autolinkhijacker_filter($courseid, $text) {

    global $CFG;

    // Derive replacement URL from replacement pattern from settings.
    if (!isset($CFG->filter_autolinkhijacker_url)){
        set_config('filter_autolinkhijacker_url',
            get_string('urldefault', 'filter_autolinkhijacker')
        );
    }

    $replacementpattern = $CFG->filter_autolinkhijacker_url;

    preg_match(
        '/(.+)\{glossaryterm\}(.*)/i',
        $replacementpattern,
        $urlparts
    );

    $urlstart   = $urlparts[1];
    $urlend    = $urlparts[2];

    // Replace the target URL of all glossary auto-links. Capture original parts for possible re-use.
    $regex = '/
        <a
        .+?
        class="([^"]*)"                  # $1
        .+?
        title="([^"]*)"                     # $2
        .+?
        href="(.+?concept=(.+?))"  # $3 (href) $4 (concept)
        .+?
        >
        /six';

    $text = preg_replace(
        $regex,
        "<a href=\"$urlstart$4$urlend\" target='_blank' title='$2' class='autolinkhijacker' style='outline: 2px dashed lime; background:yellow;'>",
        $text
    );
    return $text;
}