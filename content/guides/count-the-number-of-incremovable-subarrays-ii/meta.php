<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Incremovable Subarrays II: prefix pointer, suffix pointer',
    'leetcode' => 2972,
    'difficulty' => 'Hard',
    'summary' => 'Let nums[0 … i] be the longest strictly increasing prefix. Removals that leave only a prefix are i + 2. For each strictly increasing suffix start j, move i left until nums[i] < nums[j] and add i + 2.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'binary-search', 'leetcode'],
    'related_session' => 'count-the-number-of-incremovable-subarrays-ii',
];
