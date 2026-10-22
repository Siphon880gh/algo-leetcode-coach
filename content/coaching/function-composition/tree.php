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
            'message' => "Read the problem statement above.\nWhich function runs first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last one', 'next' => 's2'],
                ['label' => 'The first one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Composition reads right to left; Example 1 → 50 instead of 65.\nStep back to when you started at the front.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Starting value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'x', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The chain must start from the input; Example 1 → 1 instead of 65.\nStep back to when you started from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per call. Examples → 65, 1000, 42.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
