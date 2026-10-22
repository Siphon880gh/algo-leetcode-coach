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
            'message' => "Read the problem statement above.\nWhere can you start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any cell of the first column', 'next' => 's2'],
                ['label' => 'Only the top-left cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Any first-column cell is a start; [[2, 2, 1], [1, 2, 2]] → 0 instead of 1.\nStep back to when you started at the top.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of reachable cells', 'next' => 'wrong_b'],
                ['label' => 'The last column index reached', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Moves equal columns advanced; example 1 → 12 instead of 3.\nStep back to when you counted cells.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
