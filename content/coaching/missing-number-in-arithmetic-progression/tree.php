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
            'message' => "Problem: An arithmetic progression lost one value that was neither first nor last. Given the rest, return the missing value. For instance, [5,7,11,13] gives 9 and [15,13,12] gives 14. (Restated from memory; limits and examples may differ slightly.)\nStep from arr[1] − arr[0]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: (last − first) / n', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The gap may be between the first two.\nStep back to when you used the first gap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why divide by n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Divide by n − 1', 'next' => 'wrong_b'],
                ['label' => 'The full sequence had n + 1 terms', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One term is missing, so there were n gaps.\nStep back to when you used n − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Step is 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return arr[0]', 'next' => 'success'],
                ['label' => 'Return −1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. All values were equal, so the missing one is that value.\nStep back to when you returned −1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). [5,7,11,13] → 9. [15,13,12] → 14.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
