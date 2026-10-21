<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Domino Rotations For Equal Row: only two candidate values',
    'leetcode' => 1007,
    'difficulty' => 'Med',
    'summary' => 'If a row can become all x, then x appears on domino 0, so x is tops[0] or bottoms[0]. For each candidate, count rotations needed to make the top row x and the bottom row x; fail if some domino has x on neither face.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'leetcode'],
    'related_session' => 'minimum-domino-rotations-for-equal-row',
];
