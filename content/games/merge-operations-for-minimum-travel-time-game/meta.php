<?php
declare(strict_types=1);

return [
    'title' => 'Merge Operations for Minimum Travel Time',
    'leetcode' => 3538,
    'difficulty' => 'Hard',
    'summary' => 'Merging sign i into i+1 removes sign i and adds its rate to the next sign, so each kept sign\'s rate is the sum of the removed run before it. DP over (last kept sign, merges used, rate of the run) finds the cheapest k merges.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'merge-operations-for-minimum-travel-time',
    'related_session' => 'merge-operations-for-minimum-travel-time',
];
