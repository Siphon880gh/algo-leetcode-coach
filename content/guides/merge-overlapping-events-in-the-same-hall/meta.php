<?php
declare(strict_types=1);

return [
    'title' => 'Merge Overlapping Events in the Same Hall: running max end, then islands',
    'leetcode' => 2494,
    'difficulty' => 'Hard',
    'summary' => 'Order each hall’s events by start. An event begins a new merged block when its start is past the largest end of all earlier events in that hall; a running sum of those starts numbers the blocks, and each block keeps its smallest start and largest end.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'merge-overlapping-events-in-the-same-hall',
];
