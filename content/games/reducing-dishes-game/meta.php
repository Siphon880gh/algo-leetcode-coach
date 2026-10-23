<?php
declare(strict_types=1);

return [
    'title' => 'Reducing Dishes: add dishes while the suffix sum is positive',
    'leetcode' => 1402,
    'difficulty' => 'Hard',
    'summary' => 'Sort descending. Adding the next dish shifts every chosen dish one slot later, adding (running sum + dish). Keep adding while that running sum stays positive.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'reducing-dishes',
    'related_session' => 'reducing-dishes',
];
