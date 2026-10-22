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
            'message' => "Read the problem statement above.\nWhich pile each second?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The richest', 'next' => 's2'],
                ['label' => 'The next one in order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The rule picks the maximum; Example 1 → 118 instead of 29.\nStep back to when you cycled through piles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Leave behind?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ceil(√x)', 'next' => 'wrong_b'],
                ['label' => 'floor(√x)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement floors; Example 1 → 30 instead of 29.\nStep back to when you rounded up.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k log n). Examples → 29, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
