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
            'message' => "Problem: Given an array of words, pick two indices i < j whose words differ and make the span j − i + 1 (both ends counted) as large as possible. Return that span, or 0 if every word is the same. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nPairs to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair that uses index 0 or index n − 1', 'next' => 's2'],
                ['label' => 'Only the pair (0, n − 1)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [\"a\", \"b\", \"a\"] → 0 instead of 2.\nStep back to when you checked one pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance of (i, j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j − i', 'next' => 'wrong_b'],
                ['label' => 'j − i + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [\"a\", \"a\", \"b\"] → 2 instead of 3.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L). Constructed checks → 3, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
