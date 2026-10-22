<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR Score Subarray Queries: interval DP',
    'leetcode' => 3277,
    'difficulty' => 'Hard',
    'summary' => 'The score of nums[i..j] equals score(i..j − 1) XOR score(i + 1..j). Fill that table, then best[i][j] = max(score, best[i][j − 1], best[i + 1][j]) answers every query.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-xor-score-subarray-queries',
];
