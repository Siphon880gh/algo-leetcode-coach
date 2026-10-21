<?php
declare(strict_types=1);

return [
    'title' => 'Optimal Division: a / (b / c / … / z)',
    'leetcode' => 553,
    'difficulty' => 'Med',
    'summary' => 'Add parentheses to a / b / c / … to make the value largest, and return the expression without redundant parentheses. All numbers are ≥ 2, so the best is to divide a by the smallest possible value: b / c / … / z. Answer: "a" for one number, "a/b" for two, else "a/(b/c/…/z)". [1000,100,10,2] → "1000/(100/10/2)".',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'strings', 'leetcode'],
    'related_session' => 'optimal-division',
];
