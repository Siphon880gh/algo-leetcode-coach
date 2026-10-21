<?php
declare(strict_types=1);

return [
    'title' => 'Largest Number After Mutating Substring: start at the first gain',
    'leetcode' => 1946,
    'difficulty' => 'Med',
    'summary' => 'Skip digits where change[d] ≤ d. From the first digit with change[d] > d, keep mutating while change[d] ≥ d; stop at the first digit that would shrink.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'leetcode'],
    'related_session' => 'largest-number-after-mutating-substring',
];
