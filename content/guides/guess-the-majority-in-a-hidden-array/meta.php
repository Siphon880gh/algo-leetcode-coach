<?php
declare(strict_types=1);

return [
    'title' => 'Guess the Majority in a Hidden Array: compare everything to index 0',
    'leetcode' => 1538,
    'difficulty' => 'Med',
    'summary' => 'Use query(0,1,2,3) as a reference. Replacing one index of the reference quadruple with i and seeing whether the answer changes tells whether nums[i] equals the replaced element. Classify every index as same as or different from index 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Interactive',
    'topic' => 'LeetCode · Interactive',
    'kind' => 'algo',
    'tags' => ['interactive', 'math', 'leetcode'],
    'related_session' => 'guess-the-majority-in-a-hidden-array',
];
