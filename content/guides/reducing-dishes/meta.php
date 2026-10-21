<?php
declare(strict_types=1);

return [
    'title' => 'Reducing Dishes: sort descending, add while the prefix stays positive',
    'leetcode' => 1402,
    'difficulty' => 'Hard',
    'summary' => 'Cook the most satisfying dishes last. Sorted descending, adding a dish shifts every chosen dish one slot later, increasing the total by the running prefix sum; keep adding while that prefix sum is positive.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'leetcode'],
    'related_session' => 'reducing-dishes',
];
