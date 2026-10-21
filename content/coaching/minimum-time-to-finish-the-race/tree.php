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
            'message' => "Read the problem statement above.\nHow long can one stint be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'While a lap costs ≤ changeTime + f', 'next' => 's2'],
                ['label' => 'Up to numLaps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. f · r^(x − 1) grows past any integer type long before 1000 laps.\nStep back to when you allowed unlimited stints.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Combine stints?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stay on one tire all race', 'next' => 'wrong_b'],
                ['label' => 'dp over laps with changeTime between', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 on tire 0 alone costs 2 + 6 + 18 + 54 = 80, not 21.\nStep back to when you never changed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[numLaps] − changeTime', 'next' => 'success'],
                ['label' => 'dp[numLaps]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. dp adds a change before every stint, including the first; Example 1 → 26, not 21.\nStep back to when you kept the extra change.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L + numLaps · L). Examples → 21, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
