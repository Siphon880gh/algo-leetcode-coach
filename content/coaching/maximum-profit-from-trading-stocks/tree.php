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
            'message' => "Problem: You are given two integer arrays present and future of equal length, where present[i] is what stock i costs today and future[i] is what it will be worth in a year, and an integer budget. You may buy each stock at most once, spending at most budget in total. Return the maximum profit, the sum of future[i] − present[i] over the stocks you buy. For instance, present [4,3,5], future [7,4,9], budget 8 → 5; present [2,6], future [1,5], budget 10 → 0. (Restated from memory; limits and examples may differ slightly.)\nBudget loop direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Downward', 'next' => 's2'],
                ['label' => 'Upward', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A stock gets bought twice; the first constructed case → 6 instead of 5.\nStep back to when you looped upward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value of a stock?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'future', 'next' => 'wrong_b'],
                ['label' => 'future − present', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Losing stocks look profitable; the second constructed case → 6 instead of 0.\nStep back to when you used future alone.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Spend how much?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At most budget', 'next' => 'success'],
                ['label' => 'Exactly budget', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. present [3,3], future [5,6], budget 5: no purchase costs exactly 5, so → impossible instead of 3.\nStep back to when you required exact spending.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · budget). Constructed cases → 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
