<?php

/*  Rheda: visualizer and control panel
 *  Copyright (C) 2016  o.klimenko aka ctizen
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace Rheda;

if (file_exists(__DIR__ . '/local/index.php')) {
    include __DIR__ . '/local/index.php';
} else {
    class Sysconf
    {
        // Single event mode settings; enable SINGLE_MODE and fill others with any non-empty value
        const SINGLE_MODE = false; // next items won't work until this is false
        const OVERRIDE_EVENT_ID = 1;
        const SUPER_ADMIN_PASS = 'hjpjdstckjybrb';
        const SUPER_ADMIN_COOKIE = 'kldfmewmd9vbeiogbjsdvjepklsdmnvmn';
        const SUPER_ADMIN_COOKIE_LIFE = 86400;
        const DEBUG_MODE_COOKIE_LIFE = 86400;

        // Multi-event mode auth settings. Will not work when single mode is active
        // Also this will not work if DEBUG_MODE is set to true: every event will
        // have admin password 'password' when pantheon is in debug mode
        public static function ADMIN_AUTH() {
            return [
                // event id -> auth
                // default cookie_life is 3600 (it will be used when cookie_life is not specified for the event)
                100500 => ['cookie' => 'verysecretcookie', 'password' => 'verysecretpassword'],
                100501 => ['cookie' => 'verysecretcookie', 'password' => 'verysecretpassword', 'cookie_life' => 7200],
            ];
        }

        // Common settings
        const API_VERSION_MAJOR = 1;
        const API_VERSION_MINOR = 0;
        const DEBUG_MODE = true; // TODO -> to false in prod!
        const API_ADMIN_TOKEN = 'CHANGE_ME'; // TODO -> change it on prod!

        public static function API_URL() {
            return getenv('MIMIR_URL');
        }

        public static function MOBILE_CLIENT_URL() {
            return getenv('TYR_URL');
        }
    }
}


