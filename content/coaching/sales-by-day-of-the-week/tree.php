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
            'message' => "Problem: An orders table records item quantities with dates; an items table gives each item's category. Report per category the quantity ordered on each weekday as columns, with zeros, ordered as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from which table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Items (LEFT JOIN orders)', 'next' => 's2'],
                ['label' => 'Orders', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Categories without orders would vanish.\nStep back to when you started from orders.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Missing quantity for a day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Leave NULL', 'next' => 'wrong_b'],
                ['label' => 'Sum gives 0 via ELSE 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement expects zeros.\nStep back to when you left NULL.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Weekday numbering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check the dialect (Sunday may be 1)', 'next' => 'success'],
                ['label' => 'Assume Monday = 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A wrong offset shifts every column.\nStep back to when you assumed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One SUM(CASE) per weekday, grouped by category.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
