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
            'message' => "Read the problem statement above.\nShrink the window while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its max − min > 2, from two deques', 'next' => 's2'],
                ['label' => 'nums[r] and nums[l] differ by more than 2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The ends are not the extremes; [5, 2, 4, 1] → 7 instead of 5.\nStep back to when you compared only the ends.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Add for each end r?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if the window is valid', 'next' => 'wrong_b'],
                ['label' => 'r − l + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every start in the window works; example 1 → 4 instead of 8.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), with a 64-bit total. Examples → 8, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
