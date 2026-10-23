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
            'message' => "Read the problem statement above.\nRed range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '30 < timer ≤ 90', 'next' => 's2'],
                ['label' => '30 ≤ timer ≤ 90, checked first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): timer = 30 → \"Red\" instead of \"Orange\".\nStep back to when you included 30 in red.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "timer = 90?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"Invalid"', 'next' => 'wrong_b'],
                ['label' => '"Red"', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): timer = 90 → \"Invalid\" instead of \"Red\".\nStep back to when you excluded 90.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → \"Red\", \"Invalid\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
