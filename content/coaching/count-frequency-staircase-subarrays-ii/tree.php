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
            'message' => "Read the problem statement above.\nA staircase with k distinct values has what length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any length', 'next' => 'wrong_a'],
                ['label' => '1 + 2 + … + k = k(k + 1) / 2', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The counts are exactly 1, 2, …, k, so the length is fixed. That leaves about √(2n) right ends per left end.\nStep back to when you allowed any length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you test one candidate window quickly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Check that the counts form 1 … k in any order', 'next' => 'wrong_b'],
                ['label' => 'Compare the window sum of h with Σ m · h(m-th new value)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. First-appearance order matters. Ignoring it gives 10 instead of 9 for Example 1.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A linked list of first occurrences plus hashing. O(n√n). Examples give 9, 5 and 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
