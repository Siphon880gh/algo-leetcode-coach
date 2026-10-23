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
            'message' => "Read the problem statement above.\nRange value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'h[r + 1] − h[l] · 10^(non-zero digits in range)', 'next' => 's2'],
                ['label' => 'h[r + 1] − h[l]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1, query [1, 3] → 22 instead of 4.\nStep back to when you skipped the shift.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shift exponent?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Range length', 'next' => 'wrong_b'],
                ['label' => 'Non-zero digits in the range', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1, query [1, 3] → 999998031 instead of 4.\nStep back to when you counted zeros.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + q log p). Examples → [12340, 4, 9], [1, 0], [444444137].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
