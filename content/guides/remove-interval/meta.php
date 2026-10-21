<?php
declare(strict_types=1);

return [
    'title' => 'Remove Interval: keep the pieces outside',
    'leetcode' => 1272,
    'difficulty' => 'Med',
    'summary' => 'Scan each interval. If it does not overlap the removal, keep it; otherwise keep its left part before the removal start and its right part after the removal end, when they are non-empty.',
    'category' => 'LeetCode',
    'subcategory' => 'Intervals',
    'topic' => 'LeetCode · Intervals',
    'kind' => 'algo',
    'tags' => ['intervals', 'arrays', 'leetcode'],
    'related_session' => 'remove-interval',
];
