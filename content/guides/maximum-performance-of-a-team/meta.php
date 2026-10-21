<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Performance of a Team: fix the minimum efficiency',
    'leetcode' => 1383,
    'difficulty' => 'Hard',
    'summary' => 'Sort engineers by efficiency descending. When engineer i is the least efficient member, the best team takes the k largest speeds among the first i + 1; keep them in a min-heap and track sum · efficiency.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'heap', 'sorting', 'leetcode'],
    'related_session' => 'maximum-performance-of-a-team',
];
