<?php
declare(strict_types=1);

return [
    'title' => 'Put Marbles in Bags: only the cut pairs matter',
    'leetcode' => 2551,
    'difficulty' => 'Hard',
    'summary' => 'Every split scores w[0] + w[n − 1] plus w[i] + w[i + 1] for each cut after i. Choose the k − 1 largest pair sums for the maximum and the k − 1 smallest for the minimum; the ends cancel.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'heap', 'leetcode'],
    'related_session' => 'put-marbles-in-bags',
];
