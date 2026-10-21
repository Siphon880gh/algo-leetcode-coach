<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Swaps to Make Strings Equal: pair up mismatches',
    'leetcode' => 1247,
    'difficulty' => 'Med',
    'summary' => 'Only mismatched positions matter: count xy (x in s1, y in s2) and yx. Two of the same kind fix in one swap, a leftover xy and yx pair needs two, and an odd total is impossible.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'strings', 'leetcode'],
    'related_session' => 'minimum-swaps-to-make-strings-equal',
];
