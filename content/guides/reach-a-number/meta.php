<?php
declare(strict_types=1);

return [
    'title' => 'Reach a Number: overshoot, then fix the parity',
    'leetcode' => 754,
    'difficulty' => 'Med',
    'summary' => 'By symmetry, use |target|. Take steps 1, 2, …, k until the sum reaches the target and the excess is even. Flipping step j subtracts 2j, so an even excess can always be removed; this takes at most two extra steps.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'leetcode'],
    'related_session' => 'reach-a-number',
];
