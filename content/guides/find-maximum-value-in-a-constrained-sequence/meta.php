<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Value in a Constrained Sequence: two passes of caps',
    'leetcode' => 3796,
    'difficulty' => 'Med',
    'summary' => 'Each position’s best value is the tightest cap reachable from any restriction (or a[0] = 0) plus the diff distance. One pass left to right and one right to left compute it.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'find-maximum-value-in-a-constrained-sequence',
];
