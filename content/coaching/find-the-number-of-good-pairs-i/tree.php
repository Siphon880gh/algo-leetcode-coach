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
            'message' => "Read the problem statement above.\nGood when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums1[i] divisible by nums2[j] · k', 'next' => 's2'],
                ['label' => 'nums2[j] · k divisible by nums1[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That reverses it: example 2 → 6 instead of 2.\nStep back to when you reversed the test.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i < j', 'next' => 'wrong_b'],
                ['label' => 'Every i and every j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The arrays are separate: example 1 → 0 instead of 5.\nStep back to when you required i < j.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n m). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
