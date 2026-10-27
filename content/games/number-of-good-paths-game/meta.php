<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Paths',
    'leetcode' => 2421,
    'difficulty' => 'Hard',
    'summary' => 'Process nodes by value. Union each node with neighbors of value at most its own. Within each new component, nodes of the current value can pair up: add c times (c+1) divided by 2 for each root with c such nodes.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-good-paths',
    'related_session' => 'number-of-good-paths',
];
