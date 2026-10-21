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
            'message' => "Read the problem statement above.\nTime until the first reply arrives?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · distance', 'next' => 's2'],
                ['label' => 'distance', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The message goes to the master and the reply comes back.\nStep back to when you used one way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last resend time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(t // p) · p', 'next' => 'wrong_b'],
                ['label' => '((t − 1) // p) · p', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A reply arriving at t stops the resend at t; in Example 1 server 2 would give 9 instead of 8.\nStep back to when you used t // p.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When is that server done?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'last + t + 1', 'next' => 'success'],
                ['label' => 'last + t', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The network is idle the second after the last reply arrives; Example 1 → 8.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + E). Examples → 8, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
