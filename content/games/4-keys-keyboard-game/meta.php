<?php
declare(strict_types=1);

return [
    'title' => '4 Keys Keyboard: type, or finish with select-copy-paste runs',
    'leetcode' => 651,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = most A\'s with i presses: either dp[i−1] + 1 (press A), or for a break point j: dp[j] times (i − j − 1) (Ctrl-A, Ctrl-C at j, then i − j − 2 pastes).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => '4-keys-keyboard',
    'related_session' => '4-keys-keyboard',
];
