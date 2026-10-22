<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Make Array Equal: weighted median',
    'leetcode' => 2448,
    'difficulty' => 'Hard',
    'summary' => 'The total cost is a convex function of the target, made of |nums[i] − x| · cost[i] terms. It is smallest at a weighted median: sort by value and take the first value where the running cost reaches half the total.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'binary-search', 'greedy', 'sorting', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-cost-to-make-array-equal',
];
