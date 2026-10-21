<?php
declare(strict_types=1);

return [
    'title' => 'Tiling a Rectangle with the Fewest Squares: skyline backtracking',
    'leetcode' => 1240,
    'difficulty' => 'Hard',
    'summary' => 'Keep the height of each column. Always fill the lowest, leftmost empty cell with a square, trying the largest that fits first, and prune any branch that already uses as many squares as the best found.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'leetcode'],
    'related_session' => 'tiling-a-rectangle-with-the-fewest-squares',
];
