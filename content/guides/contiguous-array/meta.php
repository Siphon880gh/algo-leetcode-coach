<?php
declare(strict_types=1);

return [
    'title' => 'Contiguous Array: map 0 to −1, longest zero-sum subarray',
    'leetcode' => 525,
    'difficulty' => 'Med',
    'summary' => 'Longest subarray with equal 0s and 1s. Count 0 as −1 and 1 as +1; a balanced subarray has sum 0, so two equal prefix sums bound it. Store the first index of each prefix with {0: −1}; the answer is the largest i − first[s]. [0,1] → 2. [0,1,0] → 2. Not 523.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'hash-table', 'leetcode'],
    'related_session' => 'contiguous-array',
];
