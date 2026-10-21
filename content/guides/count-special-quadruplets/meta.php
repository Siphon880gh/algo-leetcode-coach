<?php
declare(strict_types=1);

return [
    'title' => 'Count Special Quadruplets: split as a + b + c = d',
    'leetcode' => 1995,
    'difficulty' => 'Easy',
    'summary' => 'Rewrite as nums[a] + nums[b] = nums[d] − nums[c]. Walk b from the right, adding differences nums[d] − nums[c] for c = b + 1 into a counter, then look up nums[a] + nums[b] for every a < b. O(n²).',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'array', 'enumeration', 'leetcode'],
    'related_session' => 'count-special-quadruplets',
];
