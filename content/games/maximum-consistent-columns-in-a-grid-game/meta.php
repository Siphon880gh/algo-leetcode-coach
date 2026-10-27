<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Consistent Columns in a Grid',
    'leetcode' => 3989,
    'difficulty' => 'Hard',
    'summary' => 'Think of columns as a sequence: column b may follow column a if every row differs by at most limit. dp[b] = 1 + max dp[a] over compatible a < b, exactly like the longest increasing subsequence in O(n² times m).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-consistent-columns-in-a-grid',
    'related_session' => 'maximum-consistent-columns-in-a-grid',
];
