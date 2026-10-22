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
            'message' => "Read the problem statement above.\nIndex?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(i + nums[i]) mod n', 'next' => 's2'],
                ['label' => 'nums[i] mod n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Moves start at i: example 1 → [1, 1, −2, −2].\nStep back to when you dropped i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative remainders?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use % as is in C or Java', 'next' => 'wrong_b'],
                ['label' => 'Add n and take mod again', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 at i = 0 gives index −1.\nStep back to when you used the raw remainder.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1, 1, 1, 3], [−1, −1, 4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
