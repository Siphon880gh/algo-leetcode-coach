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
            'message' => "Problem: You get two arrays of equal length, nums and threshold. Starting at step 1, you repeatedly pick an unused index whose threshold is at most the current step, add its value to a running total, and move to the next step. The process ends at the first step with no such index. Return the largest total you can reach. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhat to sum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Values with threshold ≤ T, the stopping step', 'next' => 's2'],
                ['label' => 'Values with threshold ≤ n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Made-up nums = [4, 6], threshold = [2, 2] → 10 instead of 0.\nStep back to when you ignored the stop.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does the process stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'First s where no threshold equals s', 'next' => 'wrong_b'],
                ['label' => 'First s with fewer than s thresholds ≤ s', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Made-up nums = [5, 5, 5], threshold = [1, 1, 3] → 10 instead of 15.\nStep back to when you stopped on a gap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 17, 18, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
