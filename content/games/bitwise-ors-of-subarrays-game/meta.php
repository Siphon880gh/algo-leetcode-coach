<?php
declare(strict_types=1);

return [
    'title' => 'Bitwise ORs of Subarrays: keep the ORs ending here',
    'leetcode' => 898,
    'difficulty' => 'Med',
    'summary' => 'cur = set of ORs of subarrays ending at i = {x} ∪ {y | x for y in previous cur}. It stays small because ORs only gain bits. Union every cur into the answer set.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'bitwise-ors-of-subarrays',
    'related_session' => 'bitwise-ors-of-subarrays',
];
