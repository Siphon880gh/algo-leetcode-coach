<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Balanced Partition: every letter appears equally often',
    'leetcode' => 3144,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = fewest balanced pieces for s[0 to i). Grow the last piece s[j to i−1] leftward, tracking counts; it is balanced if every present letter has the same count.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-substring-partition-of-equal-character-frequency',
    'related_session' => 'minimum-substring-partition-of-equal-character-frequency',
];
