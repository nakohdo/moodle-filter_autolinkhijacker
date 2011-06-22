<?php
/*
 * This is the filter settings file for the Autolink Hijacker filter.
 * You can enter a replacement URL for glossary autolinking.
 */

$settings->add(new admin_setting_configtext('filter_autolinkhijacker_url',
    get_string('url', 'filter_autolinkhijacker'),
    get_string('urlconfig', 'filter_autolinkhijacker'),
    get_string('urldefault', 'filter_autolinkhijacker')));
