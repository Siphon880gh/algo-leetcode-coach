<?php
declare(strict_types=1);

return [
    'title' => 'String Transformation: rotations as a two-state walk',
    'leetcode' => 2851,
    'difficulty' => 'Hard',
    'summary' => 'Each operation rotates s by a nonzero shift. Track a = ways to be at shift 0, b = ways to be at one particular nonzero shift: a\' = (n − 1) times b, b\' = a + (n − 2) times b. Answer = [t == s] times a + (nonzero shifts giving t) times b.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'string-transformation',
    'related_session' => 'string-transformation',
];
