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
            'message' => "Read the problem statement above.\nOrder of collisions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest asteroid first', 'next' => 's2'],
                ['label' => 'The given order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. mass 1 with [2,1] fails in the given order but succeeds as 1 then 2.\nStep back to when you used the given order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal masses?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The planet is destroyed', 'next' => 'wrong_b'],
                ['label' => 'The planet wins', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The planet needs mass greater than or equal to the asteroid.\nStep back to when you required strictly greater.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mass type?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 10^5 asteroids of 10^5 make the mass about 10^10.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
