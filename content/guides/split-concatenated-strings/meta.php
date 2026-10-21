<?php
declare(strict_types=1);

return [
    'title' => 'Split Concatenated Strings: maximize every other string, try each cut',
    'leetcode' => 555,
    'difficulty' => 'Med',
    'summary' => 'Join strings in order into a loop, reversing any of them, then cut once to get the largest string. Every string you do not cut should be the larger of itself and its reverse. Then, for each string i, for both of its orientations and each cut position j, the candidate is cur[j:] + the other strings (i + 1 … end, 0 … i − 1) + cur[:j]. Total length ≤ 1000. ["abc","xyz"] → "zyxcba".',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'greedy', 'leetcode'],
    'related_session' => 'split-concatenated-strings',
];
