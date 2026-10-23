<?php
declare(strict_types=1);

return [
    'title' => 'Strings Rearrangeable to Contain "leet": inclusion–exclusion',
    'leetcode' => 2930,
    'difficulty' => 'Med',
    'summary' => 'Good strings have ≥ 1 l, ≥ 2 e, ≥ 1 t. Count the complement by inclusion–exclusion over "no l", "no t", "at most one e": bad = 3·25ⁿ + n·25ⁿ⁻¹ − 3·24ⁿ − 2n·24ⁿ⁻¹ + 23ⁿ + n·23ⁿ⁻¹. Answer 26ⁿ − bad.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-strings-which-can-be-rearranged-to-contain-substring',
    'related_session' => 'number-of-strings-which-can-be-rearranged-to-contain-substring',
];
