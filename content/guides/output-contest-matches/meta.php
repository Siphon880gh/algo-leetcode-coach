<?php
declare(strict_types=1);

return [
    'title' => 'Output Contest Matches: pair first with last, round by round',
    'leetcode' => 544,
    'difficulty' => 'Med',
    'summary' => 'n (a power of 2) teams ranked 1..n. Each round pairs the strongest with the weakest. Keep a list of strings ["1", …, "n"]; each round replace it with "(" + a[i] + "," + a[len − 1 − i] + ")" for the first half, until one string remains. n = 4 → "((1,4),(2,3))". n = 8 → "(((1,8),(4,5)),((2,7),(3,6)))".',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'kind' => 'algo',
    'tags' => ['recursion', 'simulation', 'strings', 'leetcode'],
    'related_session' => 'output-contest-matches',
];
