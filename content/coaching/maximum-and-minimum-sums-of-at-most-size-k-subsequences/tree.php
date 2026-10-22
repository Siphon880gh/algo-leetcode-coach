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
            'message' => "Read the problem statement above.\nSizes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every size up to k', 'next' => 's2'],
                ['label' => 'Exactly k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 12 instead of 24.\nStep back to when you used exactly k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count all equal values on both sides', 'next' => 'wrong_b'],
                ['label' => 'Break ties by sorted index', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 18 instead of 12.\nStep back to when you counted by value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + n · k). Examples → 24, 22, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
