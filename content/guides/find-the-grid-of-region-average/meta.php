<?php
declare(strict_types=1);

return [
    'title' => 'Find the Grid of Region Average: check every 3 × 3 window',
    'leetcode' => 3030,
    'difficulty' => 'Med',
    'summary' => 'For each 3 × 3 window, check every adjacent pair against the threshold. If it is a region, add its rounded-down average to each of its nine cells and count it. Each cell’s answer is its sum divided by its count, rounded down, or its own value if no region covers it.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'matrix', 'leetcode'],
    'related_session' => 'find-the-grid-of-region-average',
];
