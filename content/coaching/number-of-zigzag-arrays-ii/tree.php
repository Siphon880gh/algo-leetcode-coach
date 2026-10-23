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
            'message' => "Read the problem statement above.\nRun the part I DP?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: n can be 10^9, so use a matrix power', 'next' => 's2'],
                ['label' => 'Yes, n − 1 steps', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n can be 10^9, and 10^9 DP steps are far too slow.\nStep back to when you looped over n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Power of the step matrix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n', 'next' => 'wrong_b'],
                ['label' => 'n − 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 16 instead of 10 (that counts length n + 1).\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m³ log n). Examples → 2, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
