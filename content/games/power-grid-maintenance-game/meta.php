<?php
declare(strict_types=1);

return [
    'title' => 'Power Grid Maintenance',
    'leetcode' => 3607,
    'difficulty' => 'Med',
    'summary' => 'Label components once with union-find (going offline never changes them). Keep a min-heap of online ids per component. A check on an online station answers itself; otherwise pop offline ids off its component\'s heap and answer the top, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'power-grid-maintenance',
    'related_session' => 'power-grid-maintenance',
];
