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
            'message' => "Read the problem statement above.\nSlots per layer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '8 (keys 2–9)', 'next' => 's2'],
                ['label' => '9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 11 instead of 12.\nStep back to when you counted 9 keys.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of the i-th letter (from 0)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i / 8', 'next' => 'wrong_b'],
                ['label' => 'i / 8 + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first layer costs one press; example 1 → 0 instead of 5.\nStep back to when you dropped the +1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
