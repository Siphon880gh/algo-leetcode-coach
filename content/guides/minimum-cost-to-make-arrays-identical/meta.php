<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Make Arrays Identical: as is, or pay k and sort both',
    'leetcode' => 3424,
    'difficulty' => 'Med',
    'summary' => 'Without rearranging, the cost is Σ |arr[i] − brr[i]|. One paid rearrangement can produce any order (cut into single elements), and matching sorted to sorted is cheapest. Take the smaller of the two.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'sorting', 'leetcode'],
    'related_session' => 'minimum-cost-to-make-arrays-identical',
];
