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
            'message' => "Read the problem statement above.\nDirection?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Down each column', 'next' => 's2'],
                ['label' => 'Along each row', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2 instead of 15.\nStep back to when you went along rows.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous cell’s original value', 'next' => 'wrong_b'],
                ['label' => 'The previous cell after raising', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 11 instead of 15.\nStep back to when you used the original value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(mn). Examples → 15, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
