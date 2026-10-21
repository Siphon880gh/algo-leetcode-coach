<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Read the problem statement above.\nFilter Orders to companies other than RED and return those salespeople?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: find who sold to RED, then exclude them', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Someone who sold to RED and to another company would still appear.\nStep back to when you filtered for non-RED orders.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you find the sales ids that touched RED?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'WHERE Orders.com_id = \'RED\'', 'next' => 'wrong_b'],
                ['label' => 'Join Orders to Company on com_id, WHERE c.name = \'RED\'', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. com_id is an id; the company name lives in Company.\nStep back to when you compared the id to a name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you return everyone else?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SalesPerson WHERE sales_id NOT IN (those ids)', 'next' => 'success'],
                ['label' => 'INNER JOIN Orders, then filter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Salespeople with no orders at all vanish from an inner join, but they qualify.\nStep back to when you joined Orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Anti-join against the RED sales ids: O(n) with hashing.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
