<?php
declare(strict_types=1);

return [
    'title' => 'IPO: unlock affordable projects by capital, take the most profitable each round',
    'leetcode' => 502,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: at most k projects, each needs capital[i] and adds profits[i]. Sort by capital; each round push every affordable project into a max-heap of profits, then take the top. Stop if the heap is empty. k = 2, w = 0, [1,2,3], [0,1,1] → 4. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['greedy', 'heap', 'sorting', 'step-by-step'],
    'related_guide' => 'ipo',
];
