<?php
declare(strict_types=1);

return [
    'title' => 'Subsequence Sum After Capping Elements: grow a subset-sum bitset',
    'leetcode' => 3685,
    'difficulty' => 'Med',
    'summary' => 'Sort nums. For cap x, values below x are kept as they are and the c values ≥ x all become x. Add values to a subset-sum bitset as x passes them, then test k − j · x for j = 0 … c.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'subsequence-sum-after-capping-elements',
];
