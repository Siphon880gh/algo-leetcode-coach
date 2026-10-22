<?php
declare(strict_types=1);

return [
    'title' => 'Removing Stars From a String: a stack of kept letters',
    'leetcode' => 2390,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with a stack: push each letter, and pop on each star. Each star removes the closest letter to its left that is still there, which is the top of the stack.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'kind' => 'algo',
    'tags' => ['string', 'stack', 'simulation', 'leetcode'],
    'related_session' => 'removing-stars-from-a-string',
];
