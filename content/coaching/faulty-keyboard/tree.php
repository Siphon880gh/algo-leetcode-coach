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
            'message' => "Read the problem statement above.\nOn an i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip the flag', 'next' => 's2'],
                ['label' => 'Type it, then flip', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The i never appears on screen; example 1 → irtsng instead of rtsng.\nStep back to when you typed the i.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The flag is set at the end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return as is', 'next' => 'wrong_b'],
                ['label' => 'Reverse once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The text is backwards; example 1 → gnstr instead of rtsng.\nStep back to when you skipped the last reverse.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → rtsng, ponter.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
