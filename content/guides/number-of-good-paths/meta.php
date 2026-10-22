<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Paths: union-find by value',
    'leetcode' => 2421,
    'difficulty' => 'Hard',
    'summary' => 'Join edges in order of the larger value at their ends. Each component remembers its largest value and how many nodes hold it; merging two components with the same largest value creates one good path per pair of those nodes.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'tree', 'union-find', 'graph', 'sorting', 'leetcode'],
    'related_session' => 'number-of-good-paths',
];
