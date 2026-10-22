<?php
declare(strict_types=1);

return [
    'title' => 'Immutability Helper: record writes through a proxy, copy on write',
    'leetcode' => 2691,
    'difficulty' => 'Hard',
    'summary' => 'Hand the mutator a proxy that records writes by path instead of applying them, and that returns recorded values on later reads. Then build the result by copying only the objects along changed paths and sharing every untouched subtree.',
    'category' => 'LeetCode',
    'subcategory' => 'JavaScript',
    'topic' => 'LeetCode · JavaScript',
    'kind' => 'algo',
    'tags' => ['javascript', 'leetcode'],
    'related_session' => 'immutability-helper',
];
