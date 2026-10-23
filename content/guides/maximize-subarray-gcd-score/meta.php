<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Subarray GCD Score: gcd with the lowest power of two',
    'leetcode' => 3574,
    'difficulty' => 'Hard',
    'summary' => 'Fix the left end and extend right, tracking the gcd and the smallest power of 2 dividing an element (with its count). Doubling raises the gcd by 2 exactly when every element with that smallest power is doubled, so the score is length · gcd · 2 when that count ≤ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'enumeration', 'number-theory', 'leetcode'],
    'related_session' => 'maximize-subarray-gcd-score',
];
