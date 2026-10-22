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
            'message' => "Read the problem statement above.\nEnds with L[j] < l?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clamp the start at l', 'next' => 's2'],
                ['label' => 'Use j − L[j] + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [15, 11, 6] instead of [15, 9, 3].\nStep back to when you skipped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Per query?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Brute force', 'next' => 'wrong_b'],
                ['label' => 'Binary search plus prefix sums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That can reach 10^10 steps.\nStep back to when you brute-forced.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + q log n). Examples → [26], [15, 9, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
