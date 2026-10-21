<?php
declare(strict_types=1);

return [
    'title' => 'Previous Permutation With One Swap: rightmost descent',
    'leetcode' => 1053,
    'difficulty' => 'Med',
    'summary' => 'To get the largest smaller arrangement, change the rightmost position you can. Find the last i with arr[i] > arr[i + 1], then swap it with the largest value to its right that is smaller than arr[i], taking the leftmost copy of that value.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'leetcode'],
    'related_session' => 'previous-permutation-with-one-swap',
];
