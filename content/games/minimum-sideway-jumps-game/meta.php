<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sideway Jumps: best per lane at each point',
    'leetcode' => 1824,
    'difficulty' => 'Med',
    'summary' => 'dp[lane] = fewest side jumps to stand in that lane at point i. An obstacle makes its lane ∞. Then any open lane can be reached from the best open lane with +1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-sideway-jumps',
    'related_session' => 'minimum-sideway-jumps',
];
