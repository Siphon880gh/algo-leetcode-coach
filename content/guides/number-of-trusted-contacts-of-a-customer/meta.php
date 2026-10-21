<?php
declare(strict_types=1);

return [
    'title' => 'Number of Trusted Contacts of a Customer: per-invoice counts',
    'leetcode' => 1364,
    'difficulty' => 'Med',
    'summary' => 'Join each invoice to its customer, LEFT JOIN the customer\'s contacts, and LEFT JOIN contacts back to customers by email. COUNT the contact rows and the matched customer rows separately, grouping by invoice.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'join', 'aggregation', 'leetcode'],
    'related_session' => 'number-of-trusted-contacts-of-a-customer',
];
