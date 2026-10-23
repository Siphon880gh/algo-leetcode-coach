<?php
declare(strict_types=1);

return [
    'title' => 'Recover the Original Array: guess k from the smallest',
    'leetcode' => 2122,
    'difficulty' => 'Hard',
    'summary' => 'The smallest value is a lower. Try each 2k = nums[i] − nums[0] (positive, even); greedily match each smallest unused value x with x + 2k. The first k that matches everything gives arr = x + k.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'recover-the-original-array',
    'related_session' => 'recover-the-original-array',
];
