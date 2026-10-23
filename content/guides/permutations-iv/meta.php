<?php
declare(strict_types=1);

return [
    'title' => 'Permutations IV: count completions, skip whole blocks',
    'leetcode' => 3470,
    'difficulty' => 'Hard',
    'summary' => 'Once a number is placed, the parities of all later positions are forced, so the completions number (odds left)! · (evens left)! when the counts fit that pattern, else 0. Build the answer left to right, skipping candidates whose block is smaller than k.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'combinatorics', 'enumeration', 'leetcode'],
    'related_session' => 'permutations-iv',
];
