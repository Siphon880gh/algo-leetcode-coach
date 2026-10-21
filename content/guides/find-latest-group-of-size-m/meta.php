<?php
declare(strict_types=1);

return [
    'title' => 'Find Latest Group of Size M: merge run lengths at endpoints',
    'leetcode' => 1562,
    'difficulty' => 'Med',
    'summary' => 'Store run lengths only at run endpoints. Setting bit x merges left length l and right length r into l + r + 1; keep a count of runs of length exactly m and record the step whenever it is positive.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'simulation', 'leetcode'],
    'related_session' => 'find-latest-group-of-size-m',
];
