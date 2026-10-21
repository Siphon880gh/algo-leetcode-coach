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
            'message' => "Read the problem statement above.\nCount every pawn on the rook's row and column?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only the first piece in each direction matters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Any piece blocks the rest of the line.\nStep back to when you counted every pawn.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You hit a bishop. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it and keep going', 'next' => 'wrong_b'],
                ['label' => 'Stop that direction without counting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rooks cannot jump over pieces.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Most captures possible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4', 'next' => 'success'],
                ['label' => '8', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One pawn per direction at most.\nStep back to when you said 8.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) on the fixed 8 × 8 board. The three statement boards give 3, 0, and 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
