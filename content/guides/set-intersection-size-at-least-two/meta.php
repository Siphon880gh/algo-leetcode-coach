<?php
declare(strict_types=1);

return [
    'title' => 'Set Intersection Size At Least Two: pick the rightmost points',
    'leetcode' => 757,
    'difficulty' => 'Hard',
    'summary' => 'Sort intervals by end ascending, and by start descending on ties. Keep the two largest chosen points. Each interval already has 0, 1, or 2 of them inside; add the missing ones at its right end, where they help the most later intervals.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'intervals', 'leetcode'],
    'related_session' => 'set-intersection-size-at-least-two',
];
