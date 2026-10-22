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
            'message' => "Read the problem statement above.\nCount by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Greedy sweep', 'next' => 's2'],
                ['label' => 'Span divided by w + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Gaps cost nothing: x = 0 and 100 with w = 1 → 51 instead of 2.\nStep back to when you divided the span.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A rectangle from x covers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x through x + w − 1', 'next' => 'wrong_b'],
                ['label' => 'x through x + w', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 4 instead of 2.\nStep back to when you shortened it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 3, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
