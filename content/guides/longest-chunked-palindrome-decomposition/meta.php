<?php
declare(strict_types=1);

return [
    'title' => 'Longest Chunked Palindrome Decomposition: peel equal ends greedily',
    'leetcode' => 1147,
    'difficulty' => 'Hard',
    'summary' => 'Match the shortest prefix that equals a suffix of the remaining text, count it twice, and repeat on the middle. Taking the shortest match first is always safe, and a leftover middle counts once.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'strings', 'two-pointers', 'rolling-hash', 'leetcode'],
    'related_session' => 'longest-chunked-palindrome-decomposition',
];
