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
            'message' => "Read the problem statement above.\nWhy sort first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Children are smaller than the parent, so their counts are ready', 'next' => 's2'],
                ['label' => 'For output order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Values exceed 1, so factors are smaller than their product.\nStep back to when you ignored the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "a and x / a both exist. What do you add to dp[x]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dp[a] + dp[x / a]', 'next' => 'wrong_b'],
                ['label' => 'dp[a] · dp[x / a]', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Any left subtree pairs with any right subtree.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Are (a, b) and (b, a) different trees?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: the children swap sides', 'next' => 'success'],
                ['label' => 'No: count once', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Left and right are distinct positions.\nStep back to when you merged them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) mod 10⁹ + 7. [2,4] → 3. [2,4,5,10] → 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
