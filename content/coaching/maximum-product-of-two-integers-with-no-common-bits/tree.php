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
            'message' => "Read the problem statement above.\nCandidates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every x with its best disjoint partner', 'next' => 's2'],
                ['label' => 'Only the two largest values', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 12.\nStep back to when you took the top two.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Partner lookup?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'F[x]', 'next' => 'wrong_b'],
                ['label' => 'F[complement of x]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 4096 instead of 2048 (x pairs with itself).\nStep back to when you looked up x.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + B · 2^B). Examples → 12, 0, 2048.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
