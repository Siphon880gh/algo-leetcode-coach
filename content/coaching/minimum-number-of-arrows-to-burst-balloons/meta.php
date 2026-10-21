<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Arrows to Burst Balloons: sort by end, shoot at the end',
    'leetcode' => 452,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: fewest vertical arrows to burst every balloon [start, end] (inclusive). Sort by end; shoot at the first end; skip balloons whose start is at most that x; shoot again at the next uncovered end. [[10,16],[2,8],[1,6],[7,12]] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'sorting', 'intervals', 'step-by-step'],
    'related_guide' => 'minimum-number-of-arrows-to-burst-balloons',
];
