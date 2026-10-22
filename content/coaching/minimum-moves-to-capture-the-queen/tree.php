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
            'message' => "Read the problem statement above.\nRook on the queen’s row, bishop between them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not a 1-move capture', 'next' => 's2'],
                ['label' => 'Still 1 move', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Pieces cannot jump; rook (1, 1), bishop (1, 4), queen (1, 8) → 1 instead of 2.\nStep back to when you ignored the block.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Bishop on her diagonal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Capture in 1 regardless', 'next' => 'wrong_b'],
                ['label' => 'Check the rook is not between them', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Rook (2, 2), bishop (1, 1), queen (3, 3) → 1 instead of 2.\nStep back to when you ignored the rook.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
