<?php
declare(strict_types=1);

return [
    'title' => 'Earliest Second to Mark Indices II',
    'leetcode' => 3049,
    'difficulty' => 'Hard',
    'summary' => 'Binary search t. Walk seconds backward: at an index\'s first appearance, zeroing it costs that second plus one later free second for marking; a min-heap keeps the best zeroings when free seconds run out. The rest must be decremented and marked with leftover seconds.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'earliest-second-to-mark-indices-ii',
    'related_session' => 'earliest-second-to-mark-indices-ii',
];
