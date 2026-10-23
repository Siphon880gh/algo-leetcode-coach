<?php
declare(strict_types=1);

return [
    'title' => 'Special Permutations: bitmask with the last element',
    'leetcode' => 2741,
    'difficulty' => 'Med',
    'summary' => 'dp[mask][last] = orderings of the elements in mask ending in last, where every neighbor pair divides one way. Extend with next if next % last == 0 or last % next == 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'special-permutations',
    'related_session' => 'special-permutations',
];
