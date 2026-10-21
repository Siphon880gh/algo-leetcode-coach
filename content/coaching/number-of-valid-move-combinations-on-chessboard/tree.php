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
            'message' => "Read the problem statement above.\nIs staying in place a move?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, it counts as one option', 'next' => 's2'],
                ['label' => 'No, every piece must move', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A single rook in Example 1 has 15 combinations, including staying put.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What is a collision?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two paths that cross', 'next' => 'wrong_b'],
                ['label' => 'Two pieces on the same square at the same second', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Adjacent pieces may swap in one second, and paths may cross at different times.\nStep back to when you compared whole paths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A piece that has reached its destination?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still occupies that square', 'next' => 'success'],
                ['label' => 'Leaves the board', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Another piece passing through its final square later collides with it.\nStep back to when you removed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. At most about 28^4 combinations, each checked over 7 seconds. Examples → 15, 22, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
