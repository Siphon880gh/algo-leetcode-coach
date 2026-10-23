<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Valid Split Positions II: only O(log V) removals matter',
    'leetcode' => 4037,
    'difficulty' => 'Hard',
    'summary' => 'The prefix gcd drops to a divisor each time it changes, so it changes O(log V) times; the same holds for the suffix gcd. Removing an index where neither changes leaves every prefix and suffix gcd the same, so only the changing indices are worth trying.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'maximum-valid-split-positions-ii',
];
