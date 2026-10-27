<?php
declare(strict_types=1);

return [
    'title' => 'Number of Intersecting Interval Pairs II',
    'leetcode' => 4057,
    'difficulty' => 'Med',
    'summary' => 'Sort by start. Each interval intersects every earlier one whose end is at least its start. Keep the earlier ends in a min-heap, pop the ends below the current start, and add the heap size.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'tags' => ['intervals', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-intersecting-interval-pairs-ii',
    'related_session' => 'number-of-intersecting-interval-pairs-ii',
];
