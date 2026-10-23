<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Points Activated with One Addition: union-find on lines',
    'leetcode' => 3873,
    'difficulty' => 'Hard',
    'summary' => 'Points sharing a row or column activate together, so join each point’s x-line and y-line in a union-find. A new point at (x of one group, y of another) links the two largest groups.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'array', 'hash-table', 'leetcode'],
    'related_session' => 'maximum-points-activated-with-one-addition',
];
