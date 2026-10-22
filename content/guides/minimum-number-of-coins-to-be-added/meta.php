<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Coins to be Added: extend the reachable range',
    'leetcode' => 2952,
    'difficulty' => 'Med',
    'summary' => 'Sort coins. If every value up to reach is obtainable and the next coin is at most reach + 1, it extends reach; otherwise add coin reach + 1, which doubles the range.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'leetcode'],
    'related_session' => 'minimum-number-of-coins-to-be-added',
];
