<?php
declare(strict_types=1);

return [
    'title' => 'Implement Rand10() Using Rand7(): build 1..49, reject 41..49',
    'leetcode' => 470,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: uniform 1..10 from rand7() only. Two calls give uniform 1..49 via (rand7() − 1) × 7 + rand7(). Keep 1..40 and return (x − 1) % 10 + 1; otherwise retry. About 2.45 rand7 calls expected. Not rand7() + rand7(). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'probability', 'rejection-sampling', 'step-by-step'],
    'related_guide' => 'implement-rand10-using-rand7',
];
