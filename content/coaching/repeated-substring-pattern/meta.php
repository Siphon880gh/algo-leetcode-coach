<?php
declare(strict_types=1);

return [
    'title' => 'Repeated Substring Pattern: s is inside (s + s) minus its ends',
    'leetcode' => 459,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: can s be a shorter substring repeated twice or more? s is such a string exactly when it appears in s + s at an index strictly between 0 and |s|. Or test each period d that divides |s|. "abab" → true. "aba" → false. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'string-matching', 'kmp', 'step-by-step'],
    'related_guide' => 'repeated-substring-pattern',
];
