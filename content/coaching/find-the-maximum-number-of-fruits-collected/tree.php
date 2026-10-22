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
            'message' => "Read the problem statement above.\nChild from (0, 0)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walks the main diagonal', 'next' => 's2'],
                ['label' => 'Needs its own DP', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. It has n − 1 moves to cover n − 1 rows and n − 1 columns, so every move is diagonal.\nStep back to when you planned a DP for it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "End cell (n − 1, n − 1)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Added in each side DP', 'next' => 'wrong_b'],
                ['label' => 'Counted once, with the diagonal', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 132 instead of 100.\nStep back to when you added the end cell again.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 100, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
