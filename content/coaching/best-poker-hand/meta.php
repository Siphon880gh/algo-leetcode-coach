<?php
declare(strict_types=1);

return [
    'title' => 'Best Poker Hand: flush first, then the largest rank count',
    'leetcode' => 2347,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: test the flush before ranks, treat four of a kind as Three of a Kind, and call one pair a Pair. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'best-poker-hand',
    'tags' => ['array', 'hash-table', 'counting', 'step-by-step'],
];
