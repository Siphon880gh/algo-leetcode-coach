<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Arrows to Burst Balloons: sort by end, shoot at the end',
    'leetcode' => 452,
    'difficulty' => 'Med',
    'summary' => 'Each balloon is [start, end]; an arrow at x bursts every balloon with start ≤ x ≤ end. Sort by end. Shoot at the first end; skip every balloon whose start is ≤ that x; shoot again at the next uncovered end. [[10,16],[2,8],[1,6],[7,12]] → 2. Touching ends share an arrow. Same walk as 435.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'intervals', 'leetcode'],
    'related_session' => 'minimum-number-of-arrows-to-burst-balloons',
];
