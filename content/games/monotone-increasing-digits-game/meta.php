<?php
declare(strict_types=1);

return [
    'title' => 'Monotone Increasing Digits: lower at the drop, fill 9s',
    'leetcode' => 738,
    'difficulty' => 'Med',
    'summary' => 'Scan from the right: whenever d[i−1] > d[i], decrease d[i−1] and mark everything from i onward to become 9.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'monotone-increasing-digits',
    'related_session' => 'monotone-increasing-digits',
];
