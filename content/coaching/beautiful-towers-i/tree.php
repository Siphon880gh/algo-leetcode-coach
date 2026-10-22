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
            'message' => "Read the problem statement above.\nHeight at i, walking out from the peak?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(limit[i], height of the previous tower)', 'next' => 's2'],
                ['label' => 'limit[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That breaks the mountain shape; the examples → 14, 32, 20 instead of 13, 22, 18.\nStep back to when you used the raw limits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which peaks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only index 0', 'next' => 'wrong_b'],
                ['label' => 'Every index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best peak can be elsewhere; example 2 → 21 instead of 22.\nStep back to when you fixed the peak.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) with n ≤ 1000. Examples → 13, 22, 18.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
