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
            'message' => "Problem: You get an integer array nums and an integer k, where k divides the length n. Split nums into k consecutive blocks of equal length and reverse each block. Return the result. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nBlock length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / k', 'next' => 's2'],
                ['label' => 'k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 2, 3, 4, 5, 6] with k = 2 → [2, 1, 4, 3, 6, 5] instead of [3, 2, 1, 6, 5, 4].\nStep back to when you used blocks of length k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reverse what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The order of the blocks', 'next' => 'wrong_b'],
                ['label' => 'The values inside each block', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same check → [4, 5, 6, 1, 2, 3] instead of [3, 2, 1, 6, 5, 4].\nStep back to when you swapped whole blocks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → [3, 2, 1, 6, 5, 4], [2, 1, 4, 3, 6, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
