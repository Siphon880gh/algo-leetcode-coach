<?php
declare(strict_types=1);

return [
    'title' => 'Longest Obstacle Course at Each Position: non-decreasing LIS',
    'leetcode' => 1964,
    'difficulty' => 'Hard',
    'summary' => 'tails[L] = smallest last height of a course of length L + 1. For each obstacle, find the first tail strictly greater (upper bound), replace it; the answer is that position + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-longest-valid-obstacle-course-at-each-position',
    'related_session' => 'find-the-longest-valid-obstacle-course-at-each-position',
];
