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
            'message' => "Read the problem statement above.\nKeep per subtree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '3 largest and 2 smallest', 'next' => 's2'],
                ['label' => '3 largest only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Two negatives can win; a star with costs [−5, −4, 1, 3] → 0 at the root instead of 60.\nStep back to when you kept only the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtree with fewer than 3 nodes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Coin = 0', 'next' => 'wrong_b'],
                ['label' => 'Coin = 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The task places 1 there; example 1 → [120, 0, 0, 0, 0, 0] instead of [120, 1, 1, 1, 1, 1].\nStep back to when you placed 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [120, 1, 1, 1, 1, 1], [280, 140, 32, 1, 1, 1, 1, 1, 1], [0, 1, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
