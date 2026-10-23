<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Make Two Binary Strings Equal: count the two mismatch types',
    'leetcode' => 3800,
    'difficulty' => 'Med',
    'summary' => 'Let a = positions with s = 0, t = 1 and b = the reverse. A swap inside one string fixes one of each type, a cross swap turns one type into the other, and a flip fixes one. The cost is linear between plans, so three plans cover it: flip all, pair a with b and flip the rest, or first even out the types with cross swaps.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'string', 'leetcode'],
    'related_session' => 'minimum-cost-to-make-two-binary-strings-equal',
];
