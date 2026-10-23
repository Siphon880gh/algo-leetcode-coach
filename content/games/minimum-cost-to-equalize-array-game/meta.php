<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Equalize Array: try each target',
    'leetcode' => 3139,
    'difficulty' => 'Hard',
    'summary' => 'For each target t from max to 2·max: total increments S, largest single gap g. If 2·cost1 ≤ cost2 use singles only. Otherwise pair as much as possible: if g ≤ S − g pair ⌊S/2⌋, else pair S − g and do the rest singly.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-equalize-array',
    'related_session' => 'minimum-cost-to-equalize-array',
];
