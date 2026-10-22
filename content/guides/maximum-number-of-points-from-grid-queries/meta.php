<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Points From Grid Queries: sorted queries, one growing heap',
    'leetcode' => 2503,
    'difficulty' => 'Hard',
    'summary' => 'A query scores every cell reachable through values below it. Answer queries in increasing order, growing one region from the top-left corner with a min-heap: pop cells smaller than the query, count them, and push their neighbours.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'breadth-first-search', 'union-find', 'sorting', 'heap', 'matrix', 'leetcode'],
    'related_session' => 'maximum-number-of-points-from-grid-queries',
];
