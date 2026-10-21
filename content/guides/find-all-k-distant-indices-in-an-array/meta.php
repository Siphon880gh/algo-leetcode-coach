<?php
declare(strict_types=1);

return [
    'title' => 'Find All K-Distant Indices in an Array: sweep with the last covered index',
    'leetcode' => 2200,
    'difficulty' => 'Easy',
    'summary' => 'For each key position j, mark indices max(j − k, last + 1) … min(n − 1, j + k). Skipping what is already marked keeps the total work O(n).',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'leetcode'],
    'related_session' => 'find-all-k-distant-indices-in-an-array',
];
