<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Absolute Distance Between Mirror Pairs',
    'leetcode' => 3761,
    'difficulty' => 'Med',
    'summary' => 'Sweep j left to right. Before moving on, store reverse(nums[j]) to j in a hash map (latest index wins). At each j, if nums[j] is a key, the pair distance is j minus that stored index.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-absolute-distance-between-mirror-pairs',
    'related_session' => 'minimum-absolute-distance-between-mirror-pairs',
];
