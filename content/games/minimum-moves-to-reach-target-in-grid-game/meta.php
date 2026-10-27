<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Reach Target in Grid',
    'leetcode' => 3609,
    'difficulty' => 'Hard',
    'summary' => 'Work backwards from the target. If x > y, the last move grew x: from x/2 when x ≥ 2y (x must be even), else from x − y. Symmetric when y > x. When x = y, the previous point was (0, y) or (x, 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-moves-to-reach-target-in-grid',
    'related_session' => 'minimum-moves-to-reach-target-in-grid',
];
