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
            'message' => "Read the problem statement above.\nThe k · i term?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k · (C[n] − C[l − 1])', 'next' => 's2'],
                ['label' => 'k · (segment cost)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 100 instead of 110.\nStep back to when you dropped the index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums sum in a segment’s cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'nums[l … r]', 'next' => 'wrong_b'],
                ['label' => 'nums[0 … r]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 76 instead of 110.\nStep back to when you used only the segment.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 110, 985.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
