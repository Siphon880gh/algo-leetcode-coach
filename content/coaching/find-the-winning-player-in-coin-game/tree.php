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
            'message' => "Read the problem statement above.\nNumber of turns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(x, y div 4)', 'next' => 's2'],
                ['label' => 'min(x, y)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → Bob instead of Alice.\nStep back to when you used min(x, y).",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Alice wins when turns are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Even', 'next' => 'wrong_b'],
                ['label' => 'Odd', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 has 1 turn → Bob instead of Alice.\nStep back to when you chose even.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → Alice, Bob.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
