<?php
declare(strict_types=1);

return [
    'title' => 'Report Contiguous Dates: islands of days',
    'leetcode' => 1225,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: union both tables with a state label, keep the range, subtract a per-state row number in days from each date, and group by state and that key. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'report-contiguous-dates',
    'tags' => ['database', 'sql', 'window-functions', 'gaps-and-islands', 'step-by-step'],
];
