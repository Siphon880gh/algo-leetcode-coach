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
            'message' => "Read the problem statement above.\nStart state?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR already includes grid[0][0]', 'next' => 's2'],
                ['label' => 'XOR 0 before the first cell', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 3.\nStep back to when you left the start cell out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine up and left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep the larger', 'next' => 'wrong_b'],
                ['label' => 'Add the counts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 3.\nStep back to when you took the larger.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(16 · mn). Examples → 3, 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
