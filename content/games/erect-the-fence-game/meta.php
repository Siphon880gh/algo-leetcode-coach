<?php
declare(strict_types=1);

return [
    'title' => 'Erect the Fence: monotone chain that keeps collinear points',
    'leetcode' => 587,
    'difficulty' => 'Hard',
    'summary' => 'Sort points by x, then y. Build the lower hull and then the upper hull, popping the last point only when the turn is clockwise (cross < 0), so points on edges stay. Merge without duplicates.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'erect-the-fence',
    'related_session' => 'erect-the-fence',
];
