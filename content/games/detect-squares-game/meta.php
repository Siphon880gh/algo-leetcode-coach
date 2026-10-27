<?php
declare(strict_types=1);

return [
    'title' => 'Detect Squares',
    'leetcode' => 2013,
    'difficulty' => 'Med',
    'summary' => 'Count points with multiplicity. For count(q), treat each stored point p with |dx| = |dy| not equal to 0 as the opposite corner; it contributes cnt[p] times cnt[(q.x, p.y)] times cnt[(p.x, q.y)].',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'tags' => ['design', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'detect-squares',
    'related_session' => 'detect-squares',
];
