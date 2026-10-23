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
            'message' => "Problem: Two arrays give the coins gained (or, when negative, lost) at each mile in lane 1 and lane 2. Mario enters at any mile in lane 1, drives a contiguous stretch of at least one mile, and may switch lanes at most twice, including right at entry or just before leaving. Return the most coins he can end with. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhere can a trip start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At any mile', 'next' => 's2'],
                ['label' => 'Only at mile 0', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. lane1 = [−4, −1], lane2 = [−3, −6] → −3 instead of −1.\nStep back to when you fixed the start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Switch right at entry?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not allowed', 'next' => 'wrong_b'],
                ['label' => 'Allowed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. lane1 = [−5, −5], lane2 = [3, 4] → −1 instead of 7.\nStep back to when you forbade it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → 17, −1, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
