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
            'message' => "Problem: You get an integer array nums and an integer k. A peak is an index whose value is greater than both neighbors. Count the subarrays that contain exactly one peak and stay within k positions of it on each side. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nLimit on each side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most k positions and no other peak', 'next' => 's2'],
                ['label' => 'No other peak only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [1, 3, 1, 2, 5, 2] with k = 1 → 12 instead of 8.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left boundary?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere within k', 'next' => 'wrong_b'],
                ['label' => 'After the previous peak', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Same array with k = 5 → 16 instead of 12.\nStep back to when you let the left side reach past the previous peak.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 8, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
