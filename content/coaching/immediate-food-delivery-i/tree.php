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
            'message' => "Problem: A delivery table records each order with its order date and the customer's preferred delivery date; an order is immediate when they are equal. Report the percentage of immediate orders among all orders, rounded as the statement specifies. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nImmediate means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Preferred date equals order date', 'next' => 's2'],
                ['label' => 'Delivered within a day', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It is the same date.\nStep back to when you allowed a day.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Average over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First orders only', 'next' => 'wrong_b'],
                ['label' => 'All orders', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is the follow-up problem.\nStep back to when you kept first orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Scale?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by 100', 'next' => 'success'],
                ['label' => 'Leave as a fraction', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The output is a percentage.\nStep back to when you left the fraction.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). One rounded percentage.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
