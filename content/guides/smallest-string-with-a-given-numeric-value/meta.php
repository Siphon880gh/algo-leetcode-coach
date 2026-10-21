<?php
declare(strict_types=1);

return [
    'title' => 'Smallest String With a Given Numeric Value: fill z from the back',
    'leetcode' => 1663,
    'difficulty' => 'Med',
    'summary' => 'Build from the right: each position takes the largest letter that still leaves at least 1 per remaining position, i.e. min(26, k − remaining). The front stays as many a\'s as possible.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'leetcode'],
    'related_session' => 'smallest-string-with-a-given-numeric-value',
];
