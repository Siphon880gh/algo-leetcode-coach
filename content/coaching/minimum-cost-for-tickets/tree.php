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
            'message' => "Read the problem statement above.\nIs the 30-day pass always best per day?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: costs can be anything', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 30-day pass can cost more than thirty 1-day passes.\nStep back to when you assumed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Day d is not a travel day. dp[d] = ?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[d − 1] + costs[0]', 'next' => 'wrong_b'],
                ['label' => 'dp[d − 1]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You need no ticket on that day.\nStep back to when you paid for it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A 7-day pass ending on travel day d costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[max(0, d − 7)] + costs[1]', 'next' => 'success'],
                ['label' => 'dp[d − 1] + costs[1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The pass also covers the six days before today.\nStep back to when you used dp[d − 1].",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(365). days = [1,4,6,7,8,20], costs = [2,7,15] → 11. days = [1,2,3,4,5,6,7,8,9,10,30,31], costs = [2,7,15] → 17.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
