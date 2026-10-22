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
            'message' => "Read the problem statement above.\nMoves required?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At least one', 'next' => 's2'],
                ['label' => 'Zero allowed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 0 instead of −1.\nStep back to when you allowed zero moves.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subtract which minimum?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Over the whole grid', 'next' => 'wrong_b'],
                ['label' => 'Over cells above-left of the end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You can only move down or right: example 1 → 13 instead of 9.\nStep back to when you used the whole grid.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m n). Examples → 9, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
