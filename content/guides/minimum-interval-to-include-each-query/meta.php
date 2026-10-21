<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Interval to Include Each Query: offline sweep with a heap',
    'leetcode' => 1851,
    'difficulty' => 'Hard',
    'summary' => 'Sort intervals by left end and process queries in increasing order. Push every interval starting at or before the query into a min-heap keyed by size; pop heap tops whose right end is before the query. The top is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'sorting', 'line-sweep', 'leetcode'],
    'related_session' => 'minimum-interval-to-include-each-query',
];
