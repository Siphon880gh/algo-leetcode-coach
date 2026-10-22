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
            'message' => "Read the problem statement above.\nMembership test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash set', 'next' => 's2'],
                ['label' => 'Scan nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is up to 10^10 steps.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'head, checking head.next', 'next' => 'wrong_b'],
                ['label' => 'A dummy before head', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The head itself is never tested: example 1 → [1, 4, 5] instead of [4, 5].\nStep back to when you started at head.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → [4, 5], [2, 2, 2], [1, 2, 3, 4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
