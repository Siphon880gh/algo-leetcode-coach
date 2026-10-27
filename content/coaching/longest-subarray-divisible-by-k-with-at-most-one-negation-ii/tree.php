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
            'message' => "Read the problem statement above.\nn = 10^5. Rescan once per negated index, like part I?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_a'],
                ['label' => 'No, one scan, since k ≤ 3000', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(n²), about 10^10 steps.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "nums = [2, 3], k = 4\nCan subarray [2] negate the 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, 2 − 6 = −4 is divisible by 4', 'next' => 'wrong_b'],
                ['label' => 'No, the negated element must be inside the subarray', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The 3 is outside [2]. Allowing outside elements gives 1 instead of 0.\nStep back to when you borrowed the 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. First indices per remainder, unlocked by each element. O(n + k²). Examples give 3, 2 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
