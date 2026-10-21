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
            'message' => "Read the problem statement above.\nContribution of position i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The current run length', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every substring of the run ending at i counts.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run reset?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'To 0', 'next' => 'wrong_b'],
                ['label' => 'To 1 when the letter changes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new letter itself starts a run of length 1.\nStep back to when you reset to 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Modulo needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, totals reach about 5 · 10^9', 'next' => 'success'],
                ['label' => 'No', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One run of 10^5 letters gives 5 · 10^9.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 13, 2, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
