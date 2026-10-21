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
            'message' => "Read the problem statement above.\nLower bound for the second cut j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P[j] ≥ 2 · P[i]', 'next' => 's2'],
                ['label' => 'P[j] > P[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The middle sum P[j] − P[i] must be ≥ P[i].\nStep back to when you used P[i].",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upper bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'P[j] ≤ P[n]', 'next' => 'wrong_b'],
                ['label' => 'P[j] ≤ (P[i] + P[n]) / 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right part must be ≥ the middle.\nStep back to when you used the total.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Right part non-empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j ≤ n − 1', 'next' => 'success'],
                ['label' => 'j ≤ n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All three parts must be non-empty.\nStep back to when you allowed j = n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
