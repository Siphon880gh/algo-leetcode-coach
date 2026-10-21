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
            'message' => "Read the problem statement above.\nHow to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The prefix-sum shape is fixed; count valid starts', 'next' => 's2'],
                ['label' => 'Try every start in [lower, upper] and simulate', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Up to 10^5 starts times 10^5 steps is 10^10.\nStep back to when you simulated each start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(upper − lower) − (mx − mn)', 'next' => 'wrong_b'],
                ['label' => '(upper − lower) − (mx − mn) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 2, not 1; both ends of the slack are valid starts.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shape taller than the range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Return the negative value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A count cannot be negative; Example 3 → 0.\nStep back to when you returned it as is.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
