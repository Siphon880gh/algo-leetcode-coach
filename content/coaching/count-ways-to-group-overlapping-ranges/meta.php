<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Group Overlapping Ranges: a > end, then 2^blocks',
    'leetcode' => 2580,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: start a block only when a range begins after the current end, and answer 2 to the number of blocks. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'count-ways-to-group-overlapping-ranges',
    'tags' => ['array', 'sorting', 'step-by-step'],
];
