<?php
declare(strict_types=1);

return [
    'title' => 'Find All Good Indices: run lengths from both sides',
    'leetcode' => 2420,
    'difficulty' => 'Med',
    'summary' => 'Precompute, for every index, how long the non-increasing run ending there is and how long the non-decreasing run starting there is. Index i is good when the run ending at i − 1 and the run starting at i + 1 both reach k.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-all-good-indices',
];
