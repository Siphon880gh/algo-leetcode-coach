<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Stay in the Same Place: left, right or stay',
    'leetcode' => 1269,
    'difficulty' => 'Hard',
    'summary' => 'ways[p] = ways to be at p. Each step: new[p] = ways[p−1] + ways[p] + ways[p+1], staying inside the array. Only positions ≤ steps/2 can come back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-ways-to-stay-in-the-same-place-after-some-steps',
    'related_session' => 'number-of-ways-to-stay-in-the-same-place-after-some-steps',
];
