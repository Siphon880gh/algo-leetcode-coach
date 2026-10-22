<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Amount of Damage Dealt to Bob: order by time per damage',
    'leetcode' => 3273,
    'difficulty' => 'Hard',
    'summary' => 'Enemy i needs t_i = ⌈health_i / power⌉ seconds. Swapping neighbours shows i should go before j when t_i · d_j < t_j · d_i. Sort by that and add d_i times each finish time.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'leetcode'],
    'related_session' => 'minimum-amount-of-damage-dealt-to-bob',
];
