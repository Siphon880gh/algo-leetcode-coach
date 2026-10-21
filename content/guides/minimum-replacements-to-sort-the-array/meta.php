<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Replacements to Sort the Array: split from the right as evenly as possible',
    'leetcode' => 2366,
    'difficulty' => 'Hard',
    'summary' => 'Go from right to left with a cap equal to the last kept value. An element x above the cap splits into k = ceil(x / cap) parts, costing k − 1 operations, and the most even split makes the new cap floor(x / k).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'greedy', 'leetcode'],
    'related_session' => 'minimum-replacements-to-sort-the-array',
];
