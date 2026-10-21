<?php
declare(strict_types=1);

return [
    'title' => 'Super Washing Machines: max of prefix flow and single-machine excess',
    'leetcode' => 517,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fewest moves to balance dresses when any set of machines can each pass one dress to a neighbor per move. total % n ≠ 0 → −1. Answer = max over i of |prefix excess| and excess a_i. [1,0,5] → 3. [0,3,0] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'arrays', 'prefix-sum', 'step-by-step'],
    'related_guide' => 'super-washing-machines',
];
