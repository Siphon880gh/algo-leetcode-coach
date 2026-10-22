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
            'message' => "Problem: You have unlimited coins of two different prime values. Return the largest price that cannot be paid exactly with them. Limits are in the official statement. For instance, values 2 and 5 → 3, and 5 and 7 → 23. (Restated from memory; limits and examples may differ slightly.)\nAnswer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'p·q − p − q', 'next' => 's2'],
                ['label' => 'p·q', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. p·q is payable with q coins of p; 2 and 5 → 10 = 5 + 5.\nStep back to when you used p·q.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Checking by DP, go up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(p, q)', 'next' => 'wrong_b'],
                ['label' => 'p·q', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The answer can be larger; 5 and 7 → 23, above 7.\nStep back to when you stopped at max(p, q).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). The examples → 3, 23.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
