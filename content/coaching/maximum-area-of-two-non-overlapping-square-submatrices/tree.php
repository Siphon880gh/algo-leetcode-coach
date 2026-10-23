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
            'message' => "Read the problem statement above.\nWhich lines?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Horizontal, and vertical via the transpose', 'next' => 's2'],
                ['label' => 'Only horizontal', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 4.\nStep back to when you skipped vertical lines.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Square on each side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest in the whole grid', 'next' => 'wrong_b'],
                ['label' => 'The largest inside that side', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 1 instead of 0.\nStep back to when you ignored the line.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 4, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
