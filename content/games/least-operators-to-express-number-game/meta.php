<?php
declare(strict_types=1);

return [
    'title' => 'Least Operators to Express Number: base-x digits, add up or borrow',
    'leetcode' => 964,
    'difficulty' => 'Hard',
    'summary' => 'Write target in base x. For each digit c at power k: either add c copies of x to the power k (pos) or subtract (x − c) after borrowing one more (neg). x to the power 0 costs 2 ops (x divided by x), x to the power k costs k. Answer: min(pos, k + neg) − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'least-operators-to-express-number',
    'related_session' => 'least-operators-to-express-number',
];
