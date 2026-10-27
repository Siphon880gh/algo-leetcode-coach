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
            'message' => "Read the problem statement above.\nExample 1 loops back to (0, 0). What stops the walk?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A visited mark on each cell', 'next' => 's2'],
                ['label' => 'Nothing; keep following arrows', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Without a visited check the arrows R, D, L, U loop forever.\nStep back to when you dropped the visited mark.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At (1, 0) the arrow points to visited (0, 0). What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[0, 0], where the arrow points', 'next' => 'wrong_b'],
                ['label' => '[1, 0], the last cell actually visited', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The blocked move is not made, so the answer is [1, 0].\nStep back to when you returned the target.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Each cell is entered at most once. O(m · n). Examples give [1, 0] and [0, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
