<?php
declare(strict_types=1);

return [
    'title' => 'Odd Even Jump: next-jump tables, then DP from the right',
    'leetcode' => 975,
    'difficulty' => 'Hard',
    'summary' => 'Precompute where an odd jump (smallest value ≥, then smallest index) and an even jump (largest value ≤, then smallest index) go from each index, using sorted indices and a monotonic stack. Then odd[i] = even[next odd target], even[i] = odd[next even target].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'monotonic-stack', 'sorting', 'leetcode'],
    'related_session' => 'odd-even-jump',
];
