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
            'message' => "Read the problem statement above.\nPeriod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2(n − 1)', 'next' => 's2'],
                ['label' => 'n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That ignores the way back: example 1 → 2 instead of 1.\nStep back to when you used n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Round trip length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n', 'next' => 'wrong_b'],
                ['label' => '2(n − 1)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The ends are not visited twice: example 1 → −1.\nStep back to when you used 2n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 1, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
