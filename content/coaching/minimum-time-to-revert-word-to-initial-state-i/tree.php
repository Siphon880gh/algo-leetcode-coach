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
            'message' => "Read the problem statement above.\nReverted at t when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'word[t·k …] is a prefix of word', 'next' => 's2'],
                ['label' => 'Only once t·k ≥ n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 2.\nStep back to when you waited for full replacement.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "If t·k ≥ n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep trying', 'next' => 'wrong_b'],
                ['label' => 'Return t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 never stops; the answer is 4.\nStep back to when you kept trying.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² / k). Examples → 2, 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
