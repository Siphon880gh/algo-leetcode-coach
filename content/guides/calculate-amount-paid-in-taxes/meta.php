<?php
declare(strict_types=1);

return [
    'title' => 'Calculate Amount Paid in Taxes: tax each bracket slice',
    'leetcode' => 2303,
    'difficulty' => 'Easy',
    'summary' => 'Walk the brackets with the previous upper bound. Each bracket taxes min(income, upper) − previous dollars at its percent; stop once income is covered.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['array', 'simulation', 'leetcode'],
    'related_session' => 'calculate-amount-paid-in-taxes',
];
