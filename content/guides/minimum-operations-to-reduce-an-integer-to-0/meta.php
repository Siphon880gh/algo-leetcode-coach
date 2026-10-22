<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Reduce an Integer to 0: carry long runs of 1s',
    'leetcode' => 2571,
    'difficulty' => 'Med',
    'summary' => 'Scan bits from the lowest. A lone 1 is removed by one subtraction; a run of two or more 1s is cheaper to clear with one addition that carries it into a single higher bit.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'greedy', 'bit-manipulation', 'leetcode'],
    'related_session' => 'minimum-operations-to-reduce-an-integer-to-0',
];
