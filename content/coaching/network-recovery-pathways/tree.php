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
            'message' => "Read the problem statement above.\nA score s works when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some path using edges ≥ s costs at most k', 'next' => 's2'],
                ['label' => 'Some path uses only edges ≥ s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 5 instead of 3.\nStep back to when you ignored k.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Offline nodes in the middle of a path?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. edges [[0, 1, 5], [1, 2, 5], [0, 2, 1]], online [true, false, true], k = 10 → 5 instead of 1.\nStep back to when you used the offline node.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + m) log m). Examples → 3, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
