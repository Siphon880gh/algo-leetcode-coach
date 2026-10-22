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
            'message' => "Read the problem statement above.\nApply each started window by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A difference array', 'next' => 's2'],
                ['label' => 'Subtracting from its k cells', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is O(n · k), about 2.5 · 10^9 updates when k = n / 2.\nStep back to when you looped over the window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value is already below 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it and move on', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It can never come back up; [1, 0, 1, 0] with k = 4 → true instead of false.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
