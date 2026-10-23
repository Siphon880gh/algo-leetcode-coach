<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Max Adjacent Difference With Two Fill Values',
    'leetcode' => 3357,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer d. Known neighbors of −1 runs define intervals each fill value must hit; pick x = smallest right end − … and check every run can use x or y (a run between a and b may need both). This game checks small cases exhaustively.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimize-the-maximum-adjacent-element-difference',
    'related_session' => 'minimize-the-maximum-adjacent-element-difference',
];
