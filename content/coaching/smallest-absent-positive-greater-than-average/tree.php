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
            'message' => "Read the problem statement above.\nStart where?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊sum / n⌋ + 1', 'next' => 's2'],
                ['label' => '⌈average⌉', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4 instead of 6 (4 equals the average).\nStep back to when you used the ceiling.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Negative average?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start at ⌊sum / n⌋ + 1 anyway', 'next' => 'wrong_b'],
                ['label' => 'Start at 1 at least', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): [−5, −3] → −2 instead of 1.\nStep back to when you skipped the clamp.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
