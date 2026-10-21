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
            'message' => "Read the problem statement above.\nProcessing order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest value first', 'next' => 's2'],
                ['label' => 'Row by row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A neighbour’s count may not be final yet; Example 1 → 7 instead of 8.\nStep back to when you went row by row.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "dp of a cell starts at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => '1, the path of just that cell', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Nothing is ever counted; Example 1 → 0 instead of 8.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which neighbours extend a path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly larger', 'next' => 'success'],
                ['label' => 'Larger or equal', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal cells are not increasing; Example 1 → 13 instead of 8.\nStep back to when you allowed equal values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log(m · n)). Examples → 8, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
