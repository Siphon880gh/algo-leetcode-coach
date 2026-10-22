<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sum of Values by Dividing Array: DP on (index, part, running AND)',
    'leetcode' => 3117,
    'difficulty' => 'Hard',
    'summary' => 'go(i, j, cur): place nums[i] into part j whose AND so far is cur. Either keep extending, or, if the AND now equals andValues[j], close the part here and add nums[i]. AND only loses bits, so each (i, j) sees few cur values.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'memoization', 'leetcode'],
    'related_session' => 'minimum-sum-of-values-by-dividing-array',
];
