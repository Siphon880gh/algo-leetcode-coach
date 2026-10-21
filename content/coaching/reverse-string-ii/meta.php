<?php
declare(strict_types=1);

return [
    'title' => 'Reverse String II: reverse the first k of every 2k block',
    'leetcode' => 541,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: reverse the first k characters of every 2k block. For i = 0, 2k, 4k, …, reverse s[i : min(i + k, n)]. "abcdefg", 2 → "bacdfeg". Not 344. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'tags' => ['strings', 'two-pointers', 'step-by-step'],
    'related_guide' => 'reverse-string-ii',
];
