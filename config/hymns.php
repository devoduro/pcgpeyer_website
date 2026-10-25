<?php

return [
    // Offline download copies lyrics onto users' phones. Keep this off until written permission to
    // distribute the hymn texts has been confirmed (see docs/03-HYMN-SOURCE-RECORD.md).
    'offline_sync_enabled' => (bool) env('HYMNS_OFFLINE_SYNC', false),

    // Hymns returned per page of a sync response.
    'sync_page_size' => 200,
];
