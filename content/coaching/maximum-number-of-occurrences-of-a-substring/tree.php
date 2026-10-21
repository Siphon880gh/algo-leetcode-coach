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
            'message' => "Read the problem statement above.\nSizes to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only minSize', 'next' => 's2'],
                ['label' => 'Every size up to maxSize', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A longer frequent substring contains a minSize one at least as frequent.\nStep back to when you tried all sizes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Window qualifies when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly maxLetters', 'next' => 'wrong_b'],
                ['label' => 'Distinct letters ≤ maxLetters', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Fewer distinct letters are allowed.\nStep back to when you required exactly.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Overlapping windows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count each', 'next' => 'success'],
                ['label' => 'Skip overlaps', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. In aaaa, the window aaa occurs twice.\nStep back to when you skipped overlaps.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · minSize). \"aababcaab\" → 2. \"aaaa\" → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
