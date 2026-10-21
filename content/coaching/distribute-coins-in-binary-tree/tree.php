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
            'message' => "Read the problem statement above.\nSimulate moving coins one at a time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count the coins that must cross each edge', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is slow and hard to get right.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Excess of a subtree = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'node.val − 1', 'next' => 'wrong_b'],
                ['label' => 'node.val + left excess + right excess − 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The children's subtrees also send or need coins.\nStep back to when you ignored the children.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The left excess is −2. Moves across that edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2: coins flow into the subtree', 'next' => 'success'],
                ['label' => '0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Missing coins must still travel along that edge.\nStep back to when you ignored negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [3,0,0] → 2. [0,3,0] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
