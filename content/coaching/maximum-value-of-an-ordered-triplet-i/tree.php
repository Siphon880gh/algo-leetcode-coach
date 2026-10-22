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
            'message' => "Read the problem statement above.\nOrder of updates for each x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'ans, then best difference, then max', 'next' => 's2'],
                ['label' => 'max, then best difference, then ans', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x can then act as both j and k; [2, 3, 8, 3] → 15 instead of 0.\nStep back to when you updated max first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Start ans at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The best raw value, possibly negative', 'next' => 'wrong_b'],
                ['label' => '0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Negative values must return 0; example 3 → −3 instead of 0.\nStep back to when you allowed negatives.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 77, 133, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
