<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Operations With the Same Score II: interval DP per score',
    'leetcode' => 3040,
    'difficulty' => 'Med',
    'summary' => 'The first operation picks one of three possible scores. For each, run a memoized interval DP on (left, right): try removing the first two, the last two, or both ends whenever that pair sums to the score.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['memoization', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-number-of-operations-with-the-same-score-ii',
];
