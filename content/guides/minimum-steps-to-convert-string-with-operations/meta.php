<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Steps to Convert String with Operations: partition DP with a per-piece cost',
    'leetcode' => 3579,
    'difficulty' => 'Hard',
    'summary' => 'For one piece, mismatched positions needing a → b can be fixed in pairs with b → a by one swap; every other mismatch needs a replace. Reversing first costs 1 more. dp over cut points takes the cheapest pieces.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-steps-to-convert-string-with-operations',
];
