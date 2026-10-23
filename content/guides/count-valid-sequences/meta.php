<?php
declare(strict_types=1);

return [
    'title' => 'Count Valid Sequences: all sequences minus all-odd ones',
    'leetcode' => 4002,
    'difficulty' => 'Med',
    'summary' => 'There are C(n − 1, k − 1) sequences of k positive integers summing to n. The product is odd only when every part is odd; writing parts as 2a + 1 shows there are C((n − k) / 2 + k − 1, k − 1) of those when n − k is even, and none otherwise.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'combinatorics', 'leetcode'],
    'related_session' => 'count-valid-sequences',
];
