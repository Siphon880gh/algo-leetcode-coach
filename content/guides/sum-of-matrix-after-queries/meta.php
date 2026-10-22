<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Matrix After Queries: replay backwards',
    'leetcode' => 2718,
    'difficulty' => 'Med',
    'summary' => 'Only the last write to each cell counts. Go through the queries in reverse; a row not seen yet adds val times the columns not yet taken, and likewise for columns.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'leetcode'],
    'related_session' => 'sum-of-matrix-after-queries',
];
