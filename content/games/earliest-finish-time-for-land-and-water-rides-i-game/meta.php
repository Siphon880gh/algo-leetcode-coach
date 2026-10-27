<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Finish Time for Land and Water Rides I',
    'leetcode' => 3633,
    'difficulty' => 'Easy',
    'summary' => 'Try both orders. For land first, the best is to finish a land ride as early as possible (min start + duration), then for each water ride finish at max(that time, its start) + duration. Do the same with water first and take the smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'earliest-finish-time-for-land-and-water-rides-i',
    'related_session' => 'earliest-finish-time-for-land-and-water-rides-i',
];
