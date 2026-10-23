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
            'message' => "Problem: An array is positive when every subarray with more than two elements has a positive sum. In one operation you may replace any element with any integer in a very wide range. Return the fewest operations that make the array positive. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWindows to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every length ≥ 3', 'next' => 's2'],
                ['label' => 'Length 3 only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [−5, 3, 3, −5] → 0 instead of 1.\nStep back to when you checked only length 3.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window starts to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the start right after it', 'next' => 'wrong_b'],
                ['label' => 'Every start after the last replacement', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 0, −2, 2] → 0 instead of 1.\nStep back to when you checked one start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Checks → 1, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
