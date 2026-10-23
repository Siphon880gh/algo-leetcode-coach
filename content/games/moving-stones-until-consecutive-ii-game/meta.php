<?php
declare(strict_types=1);

return [
    'title' => 'Moving Stones Until Consecutive II',
    'leetcode' => 1040,
    'difficulty' => 'Med',
    'summary' => 'Sort. Max moves = max(s[n−1] − s[1], s[n−2] − s[0]) − n + 2 (fill gaps from one end). Min: slide a window of span < n; it needs n − (stones inside) moves, except the special case of n − 1 consecutive stones with one far away, which needs 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'moving-stones-until-consecutive-ii',
    'related_session' => 'moving-stones-until-consecutive-ii',
];
