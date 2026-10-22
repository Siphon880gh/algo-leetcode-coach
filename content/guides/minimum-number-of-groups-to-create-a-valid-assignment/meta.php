<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Groups to Create a Valid Assignment: try group sizes from the smallest count down',
    'leetcode' => 2910,
    'difficulty' => 'Med',
    'summary' => 'Groups have size s or s + 1. Try s from the smallest count down; a count c splits when c mod s ≤ c div s, using ceil(c / (s + 1)) groups. The first s that works gives the fewest groups.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'greedy', 'leetcode'],
    'related_session' => 'minimum-number-of-groups-to-create-a-valid-assignment',
];
