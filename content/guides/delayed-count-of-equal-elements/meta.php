<?php
declare(strict_types=1);

return [
    'title' => 'Delayed Count of Equal Elements: count from the right',
    'leetcode' => 3837,
    'difficulty' => 'Med',
    'summary' => 'Walk i from right to left. Before answering i, add nums[i + k + 1] to a counter, so the counter holds exactly the values at indices greater than i + k.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'counting', 'leetcode'],
    'related_session' => 'delayed-count-of-equal-elements',
];
