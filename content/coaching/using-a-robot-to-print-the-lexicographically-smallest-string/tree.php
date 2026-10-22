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
            'message' => "Read the problem statement above.\nPop the top of t while it is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '≤ the smallest letter left in s', 'next' => 's2'],
                ['label' => '< the smallest letter left in s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. An equal letter can go first, since its twin can follow; aba → aba instead of aab.\nStep back to when you made it strict.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When s is empty?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'wrong_b'],
                ['label' => 'Pop everything left in t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every letter must reach the paper; Example 1 leaves zza on the robot and prints nothing.\nStep back to when you stopped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → azz, abc, addb.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
