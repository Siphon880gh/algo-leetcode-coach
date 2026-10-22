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
            'message' => "Read the problem statement above.\nStore per value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest prefix sum before it', 'next' => 's2'],
                ['label' => 'The latest prefix sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. nums = [−1, 2, 2, 1, −4], k = 1 → 3 instead of 5.\nStep back to when you kept the latest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start the best at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'None (0 only if no pair)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The best can be negative; example 3 → 0 instead of −6.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 11, 11, −6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
