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
            'message' => "Read the problem statement above.\nRow cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mismatched mirror pairs', 'next' => 's2'],
                ['label' => 'Mismatched cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One flip fixes a pair: example 1 → 4 instead of 2.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rows + columns', 'next' => 'wrong_b'],
                ['label' => 'min(rows, columns)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only one direction is required: example 1 → 4 instead of 2.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 2, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
