<?php
declare(strict_types=1);

return [
    'title' => 'Strings Rearrangeable to Contain "leet": inclusion-exclusion',
    'leetcode' => 2930,
    'difficulty' => 'Med',
    'summary' => 'Good strings have at least 1 l, at least 2 e, at least 1 t. Count the complement by inclusion-exclusion over "no l", "no t", "at most one e": bad = 3 times 25ⁿ + n times 25ⁿ⁻¹ − 3 times 24ⁿ − 2n times 24ⁿ⁻¹ + 23ⁿ + n times 23ⁿ⁻¹. Answer 26ⁿ − bad.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-strings-which-can-be-rearranged-to-contain-substring',
    'related_session' => 'number-of-strings-which-can-be-rearranged-to-contain-substring',
];
