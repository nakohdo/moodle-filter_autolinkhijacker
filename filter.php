<?php
/* Auto-link Hijacker filter for Moodle 2.0
 * This function provides automatic linking to an arbitry URL
 * for words from a glossary for which auto-linking is activated.
 * The idea is from Timothy Takemoto, see "Automatic pronounciatin guide"
 * http://moodle.org/mod/forum/discuss.php?d=162387
 *
 * Moodle 2.0 glossar link pattern:
 * <a href="/mod/glossary/showentry.php?courseid=3&amp;eid=1&amp;displayformat=dictionary" 
 * title="Web concepts: JavaScript" 
 * class="glossary autolink glossaryid6">JavaScript</a>
 *
 * Replacement pattern and default URL: en.wikipedia.org/wiki/{glossaryterm}
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