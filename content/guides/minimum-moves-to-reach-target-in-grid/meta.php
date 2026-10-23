<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Reach Target in Grid: walk back from the target',
    'leetcode' => 3609,
    'difficulty' => 'Hard',
    'summary' => 'Undo moves from (tx, ty). If x > y, the last move was on x: halve x if x ≥ 2y (x must be even), else subtract y. Mirror for y > x. When x = y, the previous point was (0, y) or (x, 0), so try both.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'leetcode'],
    'related_session' => 'minimum-moves-to-reach-target-in-grid',
];
