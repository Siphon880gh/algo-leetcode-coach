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
            'message' => "Read the problem statement above.\nWhich element to pick?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The maximum', 'next' => 's2'],
                ['label' => 'The minimum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The score adds the picked value; Example 1 → 6 instead of 18.\nStep back to when you picked the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extra beyond m · k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k(k + 1)/2', 'next' => 'wrong_b'],
                ['label' => 'k(k − 1)/2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first pick adds nothing extra; Example 1 → 21 instead of 18.\nStep back to when you used k + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 18, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
