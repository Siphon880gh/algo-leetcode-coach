<?php
declare(strict_types=1);

return [
    'title' => 'Count Collisions of Monkeys on a Polygon: all but two choices collide',
    'leetcode' => 2550,
    'difficulty' => 'Med',
    'summary' => 'Each monkey picks one of two directions, giving 2^n outcomes. The only ways to avoid every collision are all clockwise or all counterclockwise. So the answer is 2^n − 2 modulo 10^9 + 7, by fast power.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'recursion', 'leetcode'],
    'related_session' => 'count-collisions-of-monkeys-on-a-polygon',
];
