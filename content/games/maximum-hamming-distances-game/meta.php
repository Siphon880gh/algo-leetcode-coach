<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Hamming Distances',
    'leetcode' => 3141,
    'difficulty' => 'Hard',
    'summary' => 'max Hamming(x, y) = m − min Hamming(~x, y). Multi-source BFS over all 2^m masks starting from the numbers present gives each mask\'s distance to the nearest number; answer = m − dist[~x].',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-hamming-distances',
    'related_session' => 'maximum-hamming-distances',
];
