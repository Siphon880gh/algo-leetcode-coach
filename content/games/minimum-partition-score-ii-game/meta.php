<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Partition Score II',
    'leetcode' => 3929,
    'difficulty' => 'Hard',
    'summary' => 'Same cost as part I, but n is 5 times 10 to the power 4. The best score is convex in the number of parts, so use the Aliens trick: add a penalty λ per part, solve the unconstrained DP with a convex hull, and binary search λ until the DP uses k parts.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-partition-score-ii',
    'related_session' => 'minimum-partition-score-ii',
];
