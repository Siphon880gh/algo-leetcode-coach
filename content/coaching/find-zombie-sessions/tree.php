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
            'message' => "Read the problem statement above.\nClick-to-scroll test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly less than 0.20', 'next' => 's2'],
                ['label' => 'At most 0.20', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. S003 (1 / 5 = 0.20) is added.\nStep back to when you allowed 0.20.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compute the ratio how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide the two integer counts directly', 'next' => 'wrong_b'],
                ['label' => 'Multiply by 1.0 before dividing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In SQLite, 1 / 5 = 0, so S003 is added. (MySQL’s / returns a decimal.)\nStep back to when you divided integers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → S001, 201, 35, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
