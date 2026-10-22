<?php
declare(strict_types=1);

return [
    'title' => 'Eat Pizzas!: largest for odd days, then every second one',
    'leetcode' => 3457,
    'difficulty' => 'Med',
    'summary' => 'Sort descending. The ⌈d / 2⌉ odd days take the largest pizzas as Z. Each even day gains its Y, but Z must be at least Y, so skip one pizza and take the next for each even day.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'leetcode'],
    'related_session' => 'eat-pizzas',
];
