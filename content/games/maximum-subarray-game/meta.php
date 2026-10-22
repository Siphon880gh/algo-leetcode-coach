<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray: extend or restart',
    'leetcode' => 53,
    'difficulty' => 'Med',
    'summary' => 'Carry cur = best sum ending at i. At each x, extend (cur + x) or restart (x), whichever is bigger. A negative running sum is never worth keeping.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['kadane', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray',
    'related_session' => 'maximum-subarray',
];
