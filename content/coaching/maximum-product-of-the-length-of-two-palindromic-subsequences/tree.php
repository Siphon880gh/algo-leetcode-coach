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
            'message' => "Read the problem statement above.\nTake the longest palindromic subsequence first, then the best of the rest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, check pairs of masks', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For abaabab that greedy reaches 6, but 3 × 4 = 12 is possible.\nStep back to when you fixed the longest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Disjoint means?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two strings differ', 'next' => 'wrong_b'],
                ['label' => 'No shared index: a & b == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Disjointness is about indices; bb → 1 uses two equal strings b.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Objective?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Product of the two lengths', 'next' => 'success'],
                ['label' => 'Sum of the two lengths', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The task maximises the product.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. n ≤ 12, so at most 4096 masks. Examples → 9, 1, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
