<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Interval Selection to Cover Target Intervals',
    'leetcode' => 4086,
    'difficulty' => 'Hard',
    'summary' => 'Sort both lists by start and keep cur, how far the picks reach. For each target, while cur < its end: the first uncovered point is u = max(start, cur); among intervals starting at or before u, pick the one reaching farthest. If it does not cover u or move past cur, a gap remains.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-interval-selection-to-cover-target-intervals',
    'related_session' => 'minimum-interval-selection-to-cover-target-intervals',
];
