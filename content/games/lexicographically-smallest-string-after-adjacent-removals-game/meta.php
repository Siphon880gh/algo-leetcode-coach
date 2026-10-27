<?php
declare(strict_types=1);

return [
    'title' => 'Lexicographically Smallest String After Adjacent Removals',
    'leetcode' => 3563,
    'difficulty' => 'Hard',
    'summary' => 'Interval DP: s[i to j] can vanish if s[i] pairs with some s[m] (consecutive letters) and both s[i+1 to m−1] and s[m+1 to j] can vanish. Then best(i) = min(s[i] + best(i+1), best(j+1) for every removable s[i to j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'lexicographically-smallest-string-after-adjacent-removals',
    'related_session' => 'lexicographically-smallest-string-after-adjacent-removals',
];
