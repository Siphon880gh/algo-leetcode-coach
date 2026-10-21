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
            'message' => "Read the problem statement above.\nWhere does the move covering the leftmost X start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At that X', 'next' => 's2'],
                ['label' => 'One position before it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Starting earlier wastes coverage on cells that are already O.\nStep back to when you started early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An O at the scan position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count a move anyway', 'next' => 'wrong_b'],
                ['label' => 'Skip one position', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. O cells need no move; OOOO → 0.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "An X with fewer than three characters left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Still one move, shifted left to fit', 'next' => 'success'],
                ['label' => 'Impossible', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. XXOX → 2; the second move covers the last three characters.\nStep back to when you called it impossible.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
