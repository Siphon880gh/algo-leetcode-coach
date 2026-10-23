<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Costs Using the Train Line: regular or express lane',
    'leetcode' => 2361,
    'difficulty' => 'Hard',
    'summary' => 'reg = cheapest to reach stop i on the regular route; exp = on the express route. reg\' = min(reg, exp) + regular[i]; exp\' = min(exp, reg + expressCost) + express[i]. Answer per stop: min(reg\', exp\').',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-costs-using-the-train-line',
    'related_session' => 'minimum-costs-using-the-train-line',
];
