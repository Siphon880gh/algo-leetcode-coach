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
            'message' => "Read the problem statement above.\nA value’s count becomes 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'trimmed length += 2', 'next' => 's2'],
                ['label' => 'trimmed length += 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first copy returns too; Example 1 → 6 instead of 8.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Charge k?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Once for the whole split', 'next' => 'wrong_b'],
                ['label' => 'Once per piece', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every piece has its own importance; Example 1 → 2 instead of 8.\nStep back to when you charged k once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 8, 6, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
