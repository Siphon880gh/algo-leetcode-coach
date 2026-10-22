<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Kill All Monsters: bitmask DP over the kill set',
    'leetcode' => 2403,
    'difficulty' => 'Hard',
    'summary' => 'The gain depends only on how many monsters are already defeated, so a bitmask of the defeated set fixes it. Each transition defeats one more monster i in ceil(power[i] / gain) days; the full mask’s value is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'bit-manipulation', 'bitmask', 'leetcode'],
    'related_session' => 'minimum-time-to-kill-all-monsters',
];
