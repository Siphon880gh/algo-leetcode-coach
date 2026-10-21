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
            'message' => "Problem: Count the ways to put n distinct candies into k bags so that every bag is non-empty, where only which candies share a bag matters (bags are not labelled). Return the count modulo 1e9+7. For instance, n = 3, k = 2 → 3 and n = 4, k = 2 → 7. (Restated from memory; limits and examples may differ slightly.)\nNew candy joins an existing bag?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'j choices', 'next' => 's2'],
                ['label' => '1 choice', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Candies are distinct, so each bag is a different outcome.\nStep back to when you used 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Are bags labelled?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: do not multiply by k!', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only groupings matter.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Base case?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0][0] = 1', 'next' => 'success'],
                ['label' => 'dp[1][1] = 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One candy in one bag is one way.\nStep back to when you set 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k). Constructed check: (3, 2) → 3, (4, 2) → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
