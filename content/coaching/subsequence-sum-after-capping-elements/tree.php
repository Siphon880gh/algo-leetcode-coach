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
            'message' => "Read the problem statement above.\nCapped elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each can add x: try j · x for j = 0 … c', 'next' => 's2'],
                ['label' => 'Leave them out', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [false, false, false, true] instead of [false, false, true, true].\nStep back to when you left them out.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many capped copies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly c, all of them', 'next' => 'wrong_b'],
                ['label' => 'Any j from 0 to c', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → all false instead of all true.\nStep back to when you used all of them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · k / w + k log n). Examples → [false, false, true, true], [true, true, true, true, true].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
