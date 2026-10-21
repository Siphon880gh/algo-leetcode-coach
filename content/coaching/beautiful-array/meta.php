<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Array: odds then evens',
    'leetcode' => 932,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: an odd plus an even is odd, so no middle element can average them; build odds from f((n+1)/2) via 2x − 1 and evens from f(n/2) via 2x. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'related_guide' => 'beautiful-array',
    'tags' => ['divide-and-conquer', 'math', 'recursion', 'step-by-step'],
];
