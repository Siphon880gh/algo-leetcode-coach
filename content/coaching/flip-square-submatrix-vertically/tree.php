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
            'message' => "Read the problem statement above.\nWhat moves?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Row x + i swaps with row x + k − 1 − i', 'next' => 's2'],
                ['label' => 'Each row of the square is reversed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [[3, 4, 3, 2], [2, 3, 2, 4]] instead of [[3, 4, 4, 2], [2, 3, 2, 3]].\nStep back to when you reversed rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which columns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The whole row', 'next' => 'wrong_b'],
                ['label' => 'Only y … y + k − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → the last column changes too: [[1, 2, 3, 4], [13, 14, 15, 16], [9, 10, 11, 12], [5, 6, 7, 8]].\nStep back to when you swapped whole rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k²). Examples → [[1, 2, 3, 4], [13, 14, 15, 8], [9, 10, 11, 12], [5, 6, 7, 16]], [[3, 4, 4, 2], [2, 3, 2, 3]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
