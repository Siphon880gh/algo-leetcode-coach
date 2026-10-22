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
            'message' => "Read the problem statement above.\nApply shifts how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference array, then a running sum', 'next' => 's2'],
                ['label' => 'Loop over each shift’s range', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 5 · 10^4 shifts over 5 · 10^4 letters is 2.5 · 10^9 steps.\nStep back to when you looped over ranges.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cancel a shift at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end', 'next' => 'wrong_b'],
                ['label' => 'end + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The last letter is left out; Example 1 → adc instead of ace.\nStep back to when you cancelled at end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Total shift is negative?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wrap into 0 … 25', 'next' => 'success'],
                ['label' => 'Use % 26 in C-like languages as is', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. There −1 % 26 is −1, not 25, so a backward shift of a leaves the alphabet.\nStep back to when you trusted %.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q). Examples → ace, catz.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
