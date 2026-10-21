<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Equal Array Elements: raising n − 1 is lowering one',
    'leetcode' => 453,
    'difficulty' => 'Med',
    'summary' => 'One move adds 1 to n − 1 elements. That is the same as subtracting 1 from one element (relative gaps are what matter). So every value must come down to the minimum: answer = sum(nums) − min(nums) × n. [1,2,3] → 3. [1,1,1] → 0. Not 462 (± one element).',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'arrays', 'leetcode'],
    'related_session' => 'minimum-moves-to-equal-array-elements',
];
