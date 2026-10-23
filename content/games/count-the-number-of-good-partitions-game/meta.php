<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Partitions: merge by last occurrence',
    'leetcode' => 2963,
    'difficulty' => 'Hard',
    'summary' => 'Equal values must stay in one piece, so each value forces [first, last] together. Merging these gives k blocks that cannot be split; any of the k − 1 borders can be cut: 2^(k − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-good-partitions',
    'related_session' => 'count-the-number-of-good-partitions',
];
