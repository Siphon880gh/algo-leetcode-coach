<?php
declare(strict_types=1);

return [
    'title' => 'Stable Subarrays With Equal Boundary and Interior Sum',
    'leetcode' => 3728,
    'difficulty' => 'Med',
    'summary' => 'With prefix sums P, [l..r] is stable when cap[l] = cap[r] and P[r] − P[l+1] = cap[r]. Sweep r, and before handling r add the pair (cap[r−2], P[r−1]) to a hash map; then count entries equal to (cap[r], P[r] − cap[r]).',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stable-subarrays-with-equal-boundary-and-interior-sum',
    'related_session' => 'stable-subarrays-with-equal-boundary-and-interior-sum',
];
