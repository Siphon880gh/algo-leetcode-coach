<?php
declare(strict_types=1);

return [
    'title' => 'Product of Two Run-Length Encoded Arrays: walk both run lists',
    'leetcode' => 1868,
    'difficulty' => 'Med',
    'summary' => 'Two pointers over the runs. Take the shorter remaining frequency, emit value product × that length, merging with the last emitted run when the product repeats; advance whichever run is used up.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'array', 'leetcode'],
    'related_session' => 'product-of-two-run-length-encoded-arrays',
];
