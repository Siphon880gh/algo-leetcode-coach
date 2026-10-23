<?php
declare(strict_types=1);

return [
    'title' => 'Odd Even Jump: precompute next jumps, then go backwards',
    'leetcode' => 975,
    'difficulty' => 'Hard',
    'summary' => 'Odd jump from i: the smallest value ≥ arr[i] to the right (smallest index on ties). Even jump: the largest value ≤ arr[i]. odd[i] = even[next], even[i] = odd[next], last index good. Count starts with odd[i] true.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'odd-even-jump',
    'related_session' => 'odd-even-jump',
];
