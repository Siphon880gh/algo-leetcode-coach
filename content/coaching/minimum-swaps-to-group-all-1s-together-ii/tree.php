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
            'message' => "Read the problem statement above.\nWindow length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The total number of 1s', 'next' => 's2'],
                ['label' => 'The number of 0s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The 1s end up filling a block of exactly that many cells.\nStep back to when you used the 0s.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Windows that wrap past the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only windows inside the array', 'next' => 'wrong_b'],
                ['label' => 'Allowed: slide over the array doubled', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3, [1,1,0,0,1], needs 0 swaps only because the window wraps.\nStep back to when you ignored wrapping.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Swaps for a window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The 0s inside it', 'next' => 'success'],
                ['label' => 'The 1s inside it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each 0 inside must be swapped with a 1 outside.\nStep back to when you counted 1s.",
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
