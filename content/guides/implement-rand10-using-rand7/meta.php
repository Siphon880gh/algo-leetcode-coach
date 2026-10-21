<?php
declare(strict_types=1);

return [
    'title' => 'Implement Rand10() Using Rand7(): build 1..49, reject 41..49',
    'leetcode' => 470,
    'difficulty' => 'Med',
    'summary' => 'Make a uniform 1..10 using only rand7(). Two calls give a uniform value in 1..49: (rand7() − 1) × 7 + rand7(). Keep values 1..40 (four copies of 1..10) and return (x − 1) % 10 + 1; otherwise try again. Expected about 2.45 calls of rand7 per result. Do not use rand7() + rand7() — sums are not uniform.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'probability', 'rejection-sampling', 'leetcode'],
    'related_session' => 'implement-rand10-using-rand7',
];
