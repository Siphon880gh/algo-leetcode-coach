<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Space Wasted From Packaging',
    'leetcode' => 1889,
    'difficulty' => 'Hard',
    'summary' => 'Sort packages with prefix sums. For each supplier (sorted boxes), each box takes the packages in (previous box, box] found by binary search: waste += box times count − their sum. Skip suppliers whose largest box is too small.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-space-wasted-from-packaging',
    'related_session' => 'minimum-space-wasted-from-packaging',
];
