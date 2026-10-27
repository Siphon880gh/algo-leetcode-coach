<?php
declare(strict_types=1);

return [
    'title' => 'Patching Array: extend the reachable range',
    'leetcode' => 330,
    'difficulty' => 'Hard',
    'summary' => 'miss = smallest sum not yet reachable (start 1). If the next number at most miss, use it: miss += num. Otherwise patch with miss itself: miss doubles. Stop once miss > n.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'patching-array',
    'related_session' => 'patching-array',
];
