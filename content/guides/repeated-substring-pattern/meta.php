<?php
declare(strict_types=1);

return [
    'title' => 'Repeated Substring Pattern: s is inside (s + s) minus its ends',
    'leetcode' => 459,
    'difficulty' => 'Easy',
    'summary' => 'Can s be formed by repeating one shorter substring? It can exactly when s appears in s + s at an index other than 0 and |s| — equivalently, (s + s).find(s, 1) < |s|. Or try every period d that divides |s|. "abab" → true. "aba" → false. "abcabcabcabc" → true. Not 686.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'string-matching', 'kmp', 'leetcode'],
    'related_session' => 'repeated-substring-pattern',
];
