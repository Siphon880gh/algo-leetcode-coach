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
            'message' => "Read the problem statement above.\nOdd id test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'employee_id % 2 = 1', 'next' => 's2'],
                ['label' => 'employee_id % 2 = 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That selects even ids.\nStep back to when you tested for 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Name test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'name NOT LIKE \'%M%\'', 'next' => 'wrong_b'],
                ['label' => 'name NOT LIKE \'M%\'', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the first character matters.\nStep back to when you matched anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ordering?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ORDER BY employee_id', 'next' => 'success'],
                ['label' => 'No ORDER BY', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement requires ordering by id.\nStep back to when you dropped ORDER BY.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 0, 0, 7400, 0, 7700.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
