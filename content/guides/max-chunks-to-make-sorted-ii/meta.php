<?php
declare(strict_types=1);

return [
    'title' => 'Max Chunks To Make Sorted II: a stack of chunk maxima',
    'leetcode' => 768,
    'difficulty' => 'Hard',
    'summary' => 'Keep a stack with the maximum of each chunk. A new value at least the top starts a new chunk; a smaller value must merge with every chunk whose maximum exceeds it, keeping the largest of those maxima. The stack size is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Monotonic Stack',
    'topic' => 'LeetCode · Monotonic Stack',
    'kind' => 'algo',
    'tags' => ['monotonic-stack', 'stack', 'greedy', 'arrays', 'leetcode'],
    'related_session' => 'max-chunks-to-make-sorted-ii',
];
