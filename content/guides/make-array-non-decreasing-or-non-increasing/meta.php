<?php
declare(strict_types=1);

return [
    'title' => 'Make Array Non-decreasing or Non-increasing: slope trick with a max-heap',
    'leetcode' => 2263,
    'difficulty' => 'Hard',
    'summary' => 'Solve non-decreasing with a max-heap: push each value, and when the heap top exceeds it, pay the gap and replace the top with the value. Run the same on the reversed array for non-increasing and return the smaller cost.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'greedy', 'heap', 'leetcode'],
    'related_session' => 'make-array-non-decreasing-or-non-increasing',
];
