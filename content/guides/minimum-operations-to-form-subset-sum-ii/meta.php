<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Form Subset Sum II: divide first, then multiply',
    'leetcode' => 4041,
    'difficulty' => 'Hard',
    'summary' => 'A multiply followed by a divide cancels out (⌊2x / 2⌋ = x), so every useful sequence is i divisions and then j multiplications: ⌊x / 2^i⌋ · 2^j for i + j operations. Run the same knapsack with these options.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'minimum-operations-to-form-subset-sum-ii',
];
