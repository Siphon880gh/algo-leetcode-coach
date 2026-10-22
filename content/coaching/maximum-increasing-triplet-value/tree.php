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
            'message' => "Problem: You are given an integer array nums. Among index triples i < j < k with nums[i] < nums[j] < nums[k], find the largest value of the triple, computed from the three elements by the formula the statement gives. The formula and limits are in the official statement. For instance, with the value taken as nums[i] − nums[j] + nums[k], nums = [5, 6, 9] → 8. (Restated from memory; limits and examples may differ slightly.)\nRight partner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest value after j', 'next' => 's2'],
                ['label' => 'First larger value after j', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the assumed formula, [1, 4, 8, 9] → 5 instead of 6.\nStep back to when you took the first larger value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Left partner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest earlier value', 'next' => 'wrong_b'],
                ['label' => 'Largest earlier value below nums[j]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It may not be below nums[j]: [9, 5, 6, 8] → 12 from 9, 5, 8, instead of 7.\nStep back to when you dropped the bound.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n) with a sorted set. Under the assumed formula, [5, 6, 9] → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
