<?php
declare(strict_types=1);

return [
    'title' => 'Report Contiguous Dates: gaps and islands',
    'leetcode' => 1225,
    'difficulty' => 'Hard',
    'summary' => 'Stack both tables with a state label, restrict to the statement\'s date range, and subtract a per-state ROW_NUMBER (in days) from each date. Equal results mark one island; group by state and that key for MIN and MAX.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'gaps-and-islands', 'leetcode'],
    'related_session' => 'report-contiguous-dates',
];
