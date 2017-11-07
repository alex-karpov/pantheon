<?php

namespace Rheda;

define('TEXT_DOMAIN', 'messages');
bindtextdomain(TEXT_DOMAIN, realpath(__DIR__ . '/../../i18n'));
textdomain(TEXT_DOMAIN);
bind_textdomain_codeset(TEXT_DOMAIN, 'UTF-8');

function _t($entry) {
    return gettext($entry);
}

function _n($entry, $plural, $count) {
    return sprintf(
        ngettext(
            (string)$entry,
            (string)$plural,
            doubleval($count)
        ),
        $count
    );
}
