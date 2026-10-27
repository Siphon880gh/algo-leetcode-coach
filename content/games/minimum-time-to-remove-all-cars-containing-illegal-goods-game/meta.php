<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Remove Illegal Cars: left part, then the rest from the right',
    'leetcode' => 2167,
    'difficulty' => 'Hard',
    'summary' => 'left[i] = best cost to clean cars 0 to i = min(left[i−1] + (s[i] == "1" ? 2 : 0), i + 1). Total = min over i of left[i] + (n − 1 − i), and also n − 0 from the right alone.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-remove-all-cars-containing-illegal-goods',
    'related_session' => 'minimum-time-to-remove-all-cars-containing-illegal-goods',
];
