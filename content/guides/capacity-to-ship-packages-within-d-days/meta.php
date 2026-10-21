<?php
declare(strict_types=1);

return [
    'title' => 'Capacity To Ship Packages Within D Days: binary search the capacity',
    'leetcode' => 1011,
    'difficulty' => 'Med',
    'summary' => 'Days needed only drop as capacity grows. Binary search capacity between the heaviest package and the total weight; for each guess, load packages in order greedily and count the days.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'greedy', 'arrays', 'leetcode'],
    'related_session' => 'capacity-to-ship-packages-within-d-days',
];
