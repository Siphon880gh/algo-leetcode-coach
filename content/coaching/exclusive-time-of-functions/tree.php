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
            'message' => "Read the problem statement above.\nCompute each call's total duration and subtract its children afterward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: charge each time slice to the function on top of a stack as you go', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Nested and recursive calls make the subtraction easy to get wrong; charging slices handles them directly.\nStep back to when you subtracted children.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An end log at t. How much goes to the top?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 't − prev, then prev = t', 'next' => 'wrong_b'],
                ['label' => 't − prev + 1, then pop and set prev = t + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The end time is inclusive: 0:start:0 and 0:end:0 is one unit.\nStep back to when you made end exclusive.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A start log at t while another function is running?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Charge t − prev to the top, push the new id, set prev = t', 'next' => 'success'],
                ['label' => 'Push the new id without charging', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The running function owned the time up to t − 1, and it must be charged before it is paused.\nStep back to when you skipped the charge.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A stack and prev, end inclusive: O(logs) time. n = 2, [\"0:start:0\",\"1:start:2\",\"1:end:5\",\"0:end:6\"] → [3,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
