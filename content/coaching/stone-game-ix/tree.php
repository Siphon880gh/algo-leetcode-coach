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
            'message' => "Read the problem statement above.\nWhat matters about each stone?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its value mod 3', 'next' => 's2'],
                ['label' => 'Its actual value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only divisibility of the running sum by 3 matters.\nStep back to when you tracked full values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Stones divisible by 3?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them', 'next' => 'wrong_b'],
                ['label' => 'Each one swaps who must continue; only their parity matters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,2] → true but [1,2,3] → false; the extra 3 flips the outcome.\nStep back to when you ignored them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Even count of zeros and no stone ≡ 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alice loses', 'next' => 'success'],
                ['label' => 'Alice wins', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. With only 1s the sum hits 1, 2, 0 or the stones run out, and Bob wins either way.\nStep back to when you gave Alice the win.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
