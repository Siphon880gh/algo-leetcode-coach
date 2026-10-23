<?php
declare(strict_types=1);

return [
    'title' => 'Last Substring in Lexicographical Order',
    'leetcode' => 1163,
    'difficulty' => 'Hard',
    'summary' => 'The answer is a suffix. Two candidate starts i < j and an offset k: compare s[i + k] with s[j + k]; the loser jumps past the compared part. O(n) overall; the winner\'s suffix is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'last-substring-in-lexicographical-order',
    'related_session' => 'last-substring-in-lexicographical-order',
];
