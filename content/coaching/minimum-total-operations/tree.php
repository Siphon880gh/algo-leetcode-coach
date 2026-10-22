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
            'message' => "Problem: Given an array, one operation adds the same integer (possibly negative) to every element of a prefix. Return the fewest operations that make all elements equal. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent pairs that differ', 'next' => 's2'],
                ['label' => 'Distinct values minus 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 2, 1] → 1 instead of 2.\nStep back to when you counted distinct values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Or measure?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max − min', 'next' => 'wrong_b'],
                ['label' => 'No size needed; one operation per change', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 3, 5, 1] → 4 instead of 2.\nStep back to when you used the range.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The guide’s checks → 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
