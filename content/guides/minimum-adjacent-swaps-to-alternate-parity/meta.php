<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Adjacent Swaps to Alternate Parity: match evens to slots',
    'leetcode' => 3587,
    'difficulty' => 'Med',
    'summary' => 'Possible only when the counts of evens and odds differ by at most 1. For a pattern, the k-th even goes to slot start + 2k; the swaps are Σ |position − slot|. Try both starts when the counts are equal.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'leetcode'],
    'related_session' => 'minimum-adjacent-swaps-to-alternate-parity',
];
