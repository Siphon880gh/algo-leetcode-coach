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
            'message' => "Read the problem statement above.\nMoving the root across an edge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '+1 along it, −1 against it', 'next' => 's2'],
                ['label' => 'Always +1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Some moves save a reversal; example 1 → [1, 3, 2, 4] instead of [1, 1, 0, 2].\nStep back to when you always added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Traverse with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Plain recursion', 'next' => 'wrong_b'],
                ['label' => 'An explicit stack or queue', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A path of 10^5 nodes hit a RecursionError in Python.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 1, 0, 2], [2, 0, 1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
