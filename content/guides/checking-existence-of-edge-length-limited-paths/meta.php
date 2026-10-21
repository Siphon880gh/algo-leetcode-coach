<?php
declare(strict_types=1);

return [
    'title' => 'Checking Existence of Edge Length Limited Paths: offline DSU',
    'leetcode' => 1697,
    'difficulty' => 'Hard',
    'summary' => 'Sort edges by length and queries by limit. For each query in increasing limit, union every edge shorter than the limit, then check whether the two nodes are connected.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'sorting', 'graph', 'leetcode'],
    'related_session' => 'checking-existence-of-edge-length-limited-paths',
];
