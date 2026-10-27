<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Finish Time for Land and Water Rides II',
    'leetcode' => 3635,
    'difficulty' => 'Med',
    'summary' => 'Finishing the first ride earlier never hurts, so for each order only the earliest first-ride finish f matters. Then each second ride ends at max(f, start) + duration; take the minimum, and the better order. O(n + m).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'earliest-finish-time-for-land-and-water-rides-ii',
    'related_session' => 'earliest-finish-time-for-land-and-water-rides-ii',
];
