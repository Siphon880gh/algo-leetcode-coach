<?php
declare(strict_types=1);

return [
    'title' => 'Super Washing Machines: max of prefix flow and single-machine excess',
    'leetcode' => 517,
    'difficulty' => 'Hard',
    'summary' => 'Fewest moves to make every machine hold the same dresses; one move lets any set of machines each pass one dress to a neighbor. If total % n ≠ 0, −1. With a = x − avg and running prefix s, the answer is max over i of |s| and a. [1,0,5] → 3. [0,3,0] → 2. [0,2,0] → −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'arrays', 'prefix-sum', 'leetcode'],
    'related_session' => 'super-washing-machines',
];
