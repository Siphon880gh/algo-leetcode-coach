<?php
declare(strict_types=1);

return [
    'title' => 'Split Array into Fibonacci Sequence: fix the first two, the rest is forced',
    'leetcode' => 842,
    'difficulty' => 'Med',
    'summary' => 'Once the first two numbers are chosen, every later number is determined, so try every split for the first two and greedily check that the remaining string spells their Fibonacci continuation. Reject leading zeros and values above 2³¹ − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'strings', 'math', 'leetcode'],
    'related_session' => 'split-array-into-fibonacci-sequence',
];
