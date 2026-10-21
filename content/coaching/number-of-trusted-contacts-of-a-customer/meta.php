<?php
declare(strict_types=1);

return [
    'title' => 'Number of Trusted Contacts of a Customer: two counts',
    'leetcode' => 1364,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: join invoices to customers, LEFT JOIN contacts, LEFT JOIN contacts to customers by email, and count both columns per invoice. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'number-of-trusted-contacts-of-a-customer',
    'tags' => ['sql', 'join', 'aggregation', 'step-by-step'],
];
