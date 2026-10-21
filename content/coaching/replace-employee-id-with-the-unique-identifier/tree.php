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
            'message' => "Read the problem statement above.\nJoin type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LEFT JOIN from Employees', 'next' => 's2'],
                ['label' => 'INNER JOIN', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Employees without a unique id would vanish.\nStep back to when you used an inner join.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Join key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'name', 'next' => 'wrong_b'],
                ['label' => 'id', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The tables share the id column.\nStep back to when you joined on name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Output order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any', 'next' => 'success'],
                ['label' => 'By unique_id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any order is accepted.\nStep back to when you forced an order.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Alice and Bob → null. Meir → 2. Winston → 3. Jonathan → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
