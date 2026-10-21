<?php
declare(strict_types=1);

return [
    'title' => 'Design Log Storage System: compare prefixes',
    'leetcode' => 635,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: zero-padded timestamps sort as strings, so cut them to the granularity\'s prefix length and compare inclusively. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-log-storage-system',
    'tags' => ['design', 'strings', 'hash-table', 'step-by-step'],
];
