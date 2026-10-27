<?php
declare(strict_types=1);

return [
    'title' => 'Block Placement Queries',
    'leetcode' => 3161,
    'difficulty' => 'Hard',
    'summary' => 'Maintain obstacles in a sorted set and a segment tree storing, at each obstacle, the gap to the previous one. For [2, x, sz]: max(range-max gap up to x, x − last obstacle at most x) at least sz.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'block-placement-queries',
    'related_session' => 'block-placement-queries',
];
