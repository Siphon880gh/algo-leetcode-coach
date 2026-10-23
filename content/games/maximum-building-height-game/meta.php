<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Building Height: tighten restrictions both ways',
    'leetcode' => 1840,
    'difficulty' => 'Hard',
    'summary' => 'Add [1, 0], sort by id. Pass left to right: limit ≤ previous limit + distance; then right to left the same. Between neighbors with limits h1, h2 at distance d, the peak is ⌊(h1 + h2 + d) / 2⌋; past the last one, last + (n − id).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-building-height',
    'related_session' => 'maximum-building-height',
];
