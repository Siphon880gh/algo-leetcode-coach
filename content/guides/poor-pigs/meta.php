<?php
declare(strict_types=1);

return [
    'title' => 'Poor Pigs: each pig has rounds + 1 outcomes, so pigs are digits',
    'leetcode' => 458,
    'difficulty' => 'Hard',
    'summary' => 'One poisoned bucket among buckets. A pig that drinks poison dies after minutesToDie; you have minutesToTest. With t = minutesToTest / minutesToDie rounds, a pig ends in one of t + 1 states (dies in round 1..t, or lives). p pigs tell apart (t + 1)^p buckets, so return the smallest p with (t + 1)^p ≥ buckets. 4, 15, 15 → 2. 1000, 15, 60 → 5.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'leetcode'],
    'related_session' => 'poor-pigs',
];
