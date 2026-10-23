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
            'message' => "Read the problem statement above.\nIndices allowed to repeat (i ≤ j ≤ k)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No, i < j < k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 0 instead of 2.\nStep back to when you required distinct indices.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to reach every triplet value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Three nested loops over the values', 'next' => 'wrong_b'],
                ['label' => 'Pair XORs first, then XOR each with every value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With 1500 values that is up to 1500³ ≈ 3.4 · 10⁹ triples.\nStep back to when you nested three loops.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|S|² + 2048 · |S|). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
