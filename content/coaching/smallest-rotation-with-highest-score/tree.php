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
            'message' => "Read the problem statement above.\nScore every rotation directly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: that is O(n²); mark each element\'s range once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n can be 10⁵.\nStep back to when you simulated rotations.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Value v at index i fails for which rotations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k in [0, v)', 'next' => 'wrong_b'],
                ['label' => 'k in [i − v + 1, i] taken mod n', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It fails when its new index (i − k) mod n is below v.\nStep back to when you used [0, v).",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The range wraps below 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Split it into [i − v + 1 + n, n − 1] and [0, i]', 'next' => 'success'],
                ['label' => 'Clamp it at 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Clamping drops the rotations at the end.\nStep back to when you clamped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [2,3,1,4,0] → 3. [1,3,0,2,4] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
