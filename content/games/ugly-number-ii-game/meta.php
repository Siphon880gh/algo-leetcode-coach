<?php
declare(strict_types=1);

return [
    'title' => 'Ugly Number II: three pointers, take the smallest candidate',
    'leetcode' => 264,
    'difficulty' => 'Med',
    'summary' => 'ugly[0] = 1. Pointers p2, p3, p5 point into the list. The next ugly number is min(2 times ugly[p2], 3 times ugly[p3], 5 times ugly[p5]); advance every pointer that produced it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'ugly-number-ii',
    'related_session' => 'ugly-number-ii',
];
