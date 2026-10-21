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
            'message' => "Read the problem statement above.\nDivision type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Floating point', 'next' => 's2'],
                ['label' => 'Integer', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The answer may be fractional.\nStep back to when you used integer division.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Duplicate extremes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove all copies', 'next' => 'wrong_b'],
                ['label' => 'Not possible: salaries are unique', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement guarantees uniqueness.\nStep back to when you handled duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Need sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: one pass', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Min and max are enough.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [4000,3000,1000,2000] → 2500.0. [1000,2000,3000] → 2000.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
