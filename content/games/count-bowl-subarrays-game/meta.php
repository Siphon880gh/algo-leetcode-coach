<?php
declare(strict_types=1);

return [
    'title' => 'Count Bowl Subarrays',
    'leetcode' => 3676,
    'difficulty' => 'Med',
    'summary' => 'Keep a decreasing stack. When nums[r] arrives, every element it pops is smaller and still "sees" r, and so does the first larger element left on the stack. Each such left end at distance ≥ 2 forms a bowl with r.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'tags' => ['mono-stack', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-bowl-subarrays',
    'related_session' => 'count-bowl-subarrays',
];
