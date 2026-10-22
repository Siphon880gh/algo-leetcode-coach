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
            'message' => "Problem: Given n, count the permutations of 1 … n (positions numbered from 1) in which every value is coprime with its position, that is gcd(value, position) = 1. Limits are in the official statement. For instance, n = 1 → 1, n = 3 → 3 and n = 4 → 4. (Restated from memory; limits and examples may differ slightly.)\nNext position for a mask?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'popcount(mask) + 1', 'next' => 's2'],
                ['label' => 'popcount(mask)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Positions start at 1; n = 3 and 4 → 1 and 2 instead of 3 and 4.\nStep back to when you used popcount alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of f over all masks', 'next' => 'wrong_b'],
                ['label' => 'f[full mask]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts partial fillings too; n = 3 → 11 instead of 3.\nStep back to when you summed every mask.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). The examples → 1, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
