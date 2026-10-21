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
            'message' => "Read the problem statement above.\nPlain recursion?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: roll three values', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. It repeats subproblems exponentially.\nStep back to when you recursed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Base values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'T0 = 1, T1 = 1, T2 = 1', 'next' => 'wrong_b'],
                ['label' => 'T0 = 0, T1 = 1, T2 = 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. T0 is 0.\nStep back to when you set T0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One step from (a, b, c)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(b, c, a + b + c)', 'next' => 'success'],
                ['label' => '(b, c, b + c)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is Fibonacci, not Tribonacci.\nStep back to when you summed two.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). n = 4 → 4. n = 25 → 1389537.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
