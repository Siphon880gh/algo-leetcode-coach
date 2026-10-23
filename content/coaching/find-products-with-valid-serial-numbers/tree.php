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
            'message' => "Read the problem statement above.\nPattern?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'SN, 4 digits, hyphen, 4 digits', 'next' => 's2'],
                ['label' => 'LIKE %SN%-%', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Product 3 (SN1234-56789) is kept.\nStep back to when you used the loose LIKE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the last digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'A word boundary', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Product 3 still matches.\nStep back to when you dropped the boundary.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Example → 1, 2, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
