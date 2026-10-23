<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Range Covering Elements from K Lists',
    'leetcode' => 632,
    'difficulty' => 'Hard',
    'summary' => 'Put the first element of each list in a min-heap and track the current max. The range [heap min, max] covers all lists; pop the min, push its successor, update; stop when a list runs out.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'smallest-range-covering-elements-from-k-lists',
    'related_session' => 'smallest-range-covering-elements-from-k-lists',
];
