<?php
declare(strict_types=1);

return [
    'title' => 'Check if Point Is Reachable: the gcd must be a power of two',
    'leetcode' => 2543,
    'difficulty' => 'Hard',
    'summary' => 'Subtracting one coordinate from the other keeps the gcd, and doubling can only multiply it by 2. Starting from gcd 1, a point is reachable exactly when gcd(targetX, targetY) is a power of two.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'number-theory', 'leetcode'],
    'related_session' => 'check-if-point-is-reachable',
];
