<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sum of Values by Dividing Array: AND each piece down to its target',
    'leetcode' => 3117,
    'difficulty' => 'Hard',
    'summary' => 'f(i, j, cur) = least sum splitting nums[i..] into pieces j.., with cur = AND of the open piece. Extend the piece, or close it here if cur == andValues[j] (adding nums[i] as its value).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-sum-of-values-by-dividing-array',
    'related_session' => 'minimum-sum-of-values-by-dividing-array',
];
