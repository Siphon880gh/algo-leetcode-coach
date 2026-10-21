<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Connect Sticks: always join the two shortest',
    'leetcode' => 1167,
    'difficulty' => 'Med',
    'summary' => 'Use a min-heap: repeatedly pop the two shortest sticks, pay their sum, and push the result. Like Huffman coding, short sticks should be counted most often.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'greedy', 'leetcode'],
    'related_session' => 'minimum-cost-to-connect-sticks',
];
