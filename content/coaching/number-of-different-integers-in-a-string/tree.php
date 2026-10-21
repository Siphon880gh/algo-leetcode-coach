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
            'message' => "Read the problem statement above.\nCompare as integers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'As stripped strings', 'next' => 's2'],
                ['label' => 'Convert to int', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Runs can be 1000 digits long in fixed-size languages.\nStep back to when you converted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All-zero run?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Empty string', 'next' => 'wrong_b'],
                ['label' => 'Normalise to "0"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zero is still an integer.\nStep back to when you produced an empty key.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "01 vs 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same integer', 'next' => 'success'],
                ['label' => 'Different', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros are ignored.\nStep back to when you kept them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
