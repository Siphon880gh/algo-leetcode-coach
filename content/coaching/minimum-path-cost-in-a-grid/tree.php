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
            'message' => "Read the problem statement above.\nmoveCost row index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The value in the cell you leave', 'next' => 's2'],
                ['label' => 'The column of the cell you leave', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 11 instead of 17.\nStep back to when you used the column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of a path includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only move costs', 'next' => 'wrong_b'],
                ['label' => 'Cell values plus move costs', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 11 instead of 17.\nStep back to when you dropped the cell values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Moves to which cells of the next row?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any column', 'next' => 'success'],
                ['label' => 'The same column only', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 18 instead of 17.\nStep back to when you stayed in the column.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n²). Examples → 17, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
