<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Transaction Each Day: rank within each date',
    'leetcode' => 1831,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: RANK() over the date part of the timestamp ordered by amount descending; keep rank 1, which keeps ties. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'maximum-transaction-each-day',
    'tags' => ['sql', 'window-function', 'step-by-step'],
];
