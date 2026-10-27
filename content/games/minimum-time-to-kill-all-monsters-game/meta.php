<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Kill All Monsters: bitmask over the killed',
    'leetcode' => 2403,
    'difficulty' => 'Hard',
    'summary' => 'gain = killed + 1, so killing monster i next takes ceil(power[i] divided by gain) days. dp[mask] = least days to kill the monsters in mask.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-kill-all-monsters',
    'related_session' => 'minimum-time-to-kill-all-monsters',
];
