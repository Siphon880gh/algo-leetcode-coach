<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Pick K Ones: fix Alice’s index',
    'leetcode' => 3086,
    'difficulty' => 'Hard',
    'summary' => 'At index i, ones at i, i − 1 and i + 1 cost 0, 1, 1. A created one costs 2 (create next to Alice, swap in), which is never worse than a one at distance ≥ 2. So use changes for whatever the near ones do not cover, and take the rest as the nearest ones, summing distances with prefix sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'minimum-moves-to-pick-k-ones',
];
