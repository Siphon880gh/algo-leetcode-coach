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
            'message' => "Read the problem statement above.\nWhen is it impossible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n − 1) % (k − 1) != 0', 'next' => 's2'],
                ['label' => 'When n < k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each merge removes exactly k − 1 piles.\nStep back to when you compared n and k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which split points m for dp[i][j]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every m from i to j − 1', 'next' => 'wrong_b'],
                ['label' => 'm = i, i + k − 1, i + 2(k − 1), …', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The left part must merge down to one pile.\nStep back to when you tried every m.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you add sum(i..j)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When (j − i) % (k − 1) == 0', 'next' => 'success'],
                ['label' => 'Always', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only then does the range end as one pile.\nStep back to when you always added.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³ / k). [3,2,4,1], k = 2 → 20. [3,2,4,1], k = 3 → −1. [3,5,1,2,6], k = 3 → 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
