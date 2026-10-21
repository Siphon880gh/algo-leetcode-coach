<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Frequency Stack: one stack per frequency',
    'leetcode' => 895,
    'difficulty' => 'Hard',
    'summary' => 'Keep each value\'s count and a stack for every frequency level. Pushing x with new count f puts x on stack f; pop takes from the highest non-empty level, which also breaks ties by recency.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'kind' => 'algo',
    'tags' => ['design', 'stack', 'hash-table', 'leetcode'],
    'related_session' => 'maximum-frequency-stack',
];
