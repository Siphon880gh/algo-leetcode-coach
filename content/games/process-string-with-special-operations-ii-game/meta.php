<?php
declare(strict_types=1);

return [
    'title' => 'Process String with Special Operations II',
    'leetcode' => 3614,
    'difficulty' => 'Hard',
    'summary' => 'Never build the string. Track only its length forward, then walk backwards: undo # by folding k into the first half (k − len divided by 2), undo % by mirroring (len − 1 − k), and when a letter sits at position k, that letter is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'tags' => ['sim', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'process-string-with-special-operations-ii',
    'related_session' => 'process-string-with-special-operations-ii',
];
