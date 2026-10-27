<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Initial Strength to Defeat All Monsters',
    'leetcode' => 4008,
    'difficulty' => 'Med',
    'summary' => 'Bonuses come from a difference array. Work backwards: need[i] = the strength you must have before monster i = max(monster − bonus, monster + need[i+1]) clamped at ≥ 0, since strength left after a fight is max(0, s − monster). Or binary search the start strength and simulate.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-initial-strength-to-defeat-all-monsters',
    'related_session' => 'minimum-initial-strength-to-defeat-all-monsters',
];
