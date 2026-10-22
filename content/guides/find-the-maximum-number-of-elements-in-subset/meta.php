<?php
declare(strict_types=1);

return [
    'title' => 'Find the Maximum Number of Elements in Subset: walk the square chain',
    'leetcode' => 3020,
    'difficulty' => 'Med',
    'summary' => 'Count values. For x > 1, climb x, x², x⁴, … while each value appears at least twice; finish with a value that appears once (length 2t + 1) or step back one (2t − 1). For x = 1 the pattern is all ones, so take the largest odd count.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'enumeration', 'leetcode'],
    'related_session' => 'find-the-maximum-number-of-elements-in-subset',
];
