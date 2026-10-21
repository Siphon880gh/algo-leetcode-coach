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
            'message' => "Read the problem statement above.\nRecompute each window sum from scratch?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: slide, adding the value that enters and subtracting the one that leaves', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n · k); sliding makes each step O(1).\nStep back to when you recomputed every window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What does best start at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'The sum of the first window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. All values can be negative, and then no window ever beats 0.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The length is fixed at k. What does that buy you?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best sum gives the best average, so divide by k once at the end', 'next' => 'success'],
                ['label' => 'Nothing: also try longer windows', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Longer windows are Maximum Average Subarray II (644); here the length is exactly k.\nStep back to when you allowed longer windows.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One sliding window, best sum / k: O(n) time, O(1) space. [1,12,-5,-6,50,3], k = 4 → 12.75.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
