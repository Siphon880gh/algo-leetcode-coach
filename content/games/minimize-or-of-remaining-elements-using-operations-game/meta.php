<?php
declare(strict_types=1);

return [
    'title' => 'Minimize OR With k Merges: decide bits from the top',
    'leetcode' => 3022,
    'difficulty' => 'Hard',
    'summary' => 'Try to clear bits from high to low. With mask = bits we want zero, count merges needed so every segment AND has no mask bits (merge until the running AND & mask = 0). If more than k, the bit must stay in the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimize-or-of-remaining-elements-using-operations',
    'related_session' => 'minimize-or-of-remaining-elements-using-operations',
];
