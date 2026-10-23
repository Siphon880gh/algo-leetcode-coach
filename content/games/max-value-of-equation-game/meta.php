<?php
declare(strict_types=1);

return [
    'title' => 'Max Value of Equation',
    'leetcode' => 1499,
    'difficulty' => 'Hard',
    'summary' => 'For i < j, yi + yj + |xi − xj| = (yi − xi) + (yj + xj). Keep a deque of earlier points with decreasing yi − xi, dropping those with xj − xi > k; the front gives the best partner.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'max-value-of-equation',
    'related_session' => 'max-value-of-equation',
];
