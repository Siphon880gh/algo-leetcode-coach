<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Total Value: binary search the cutoff gain',
    'leetcode' => 3971,
    'difficulty' => 'Hard',
    'summary' => 'Each index offers gains value, value − decay, …, so the best plan takes the m largest positive gains. Binary search the cutoff T where at least m gains are ≥ T, sum the gains above T with arithmetic series, and fill the rest with T.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'math', 'binary-search', 'leetcode'],
    'related_session' => 'maximum-total-value',
];
