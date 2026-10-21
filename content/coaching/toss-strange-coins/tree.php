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
            'message' => "Problem: Given each coin's heads probability, toss all coins once and return the probability of exactly target heads. For instance, [0.5,0.5] with target 1 gives 0.5, and [0.4] with target 1 gives 0.4. (Restated from memory; limits and examples may differ slightly.)\nEnumerate all outcomes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP over heads count', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 2ⁿ outcomes.\nStep back to when you enumerated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Loop k upward with one array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: downward', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. dp[k − 1] would already include this coin.\nStep back to when you went upward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "dp[0] after a coin?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[0] · (1 − p)', 'next' => 'success'],
                ['label' => 'Unchanged', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Zero heads needs this coin to be tails too.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · target). [0.5,0.5], 1 → 0.5. [0.4], 1 → 0.4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
