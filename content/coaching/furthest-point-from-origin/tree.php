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
            'message' => "Read the problem statement above.\nBlanks go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'With the larger of L and R', 'next' => 's2'],
                ['label' => 'Always right', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. They can cancel; example 2 → 3 instead of 5.\nStep back to when you sent them right.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '#L − #R + #_', 'next' => 'wrong_b'],
                ['label' => '|#L − #R| + #_', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sign matters; R_ → 0 instead of 2.\nStep back to when you dropped the absolute value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 5, 7.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
