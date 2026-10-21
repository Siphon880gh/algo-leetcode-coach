<?php
declare(strict_types=1);

return [
    'title' => 'Non-overlapping Intervals: sort by end, keep the earliest finish',
    'leetcode' => 435,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: fewest intervals to remove so the rest do not overlap (touching ends are fine). Sort by end; keep an interval when its start is at or after the last kept end; count the rest as removals. [[1,2],[2,3],[3,4],[1,3]] → 1. Not 56 / 452. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'sorting', 'intervals', 'step-by-step'],
    'related_guide' => 'non-overlapping-intervals',
];
