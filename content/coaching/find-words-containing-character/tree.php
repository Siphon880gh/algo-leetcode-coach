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
            'message' => "Read the problem statement above.\nTest per word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x occurs anywhere in it', 'next' => 's2'],
                ['label' => 'The word starts with x', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [] instead of [0, 1].\nStep back to when you checked only the first letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Record?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One index per occurrence', 'next' => 'wrong_b'],
                ['label' => 'Each matching index once', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. leet has two e; example 1 → [0, 0, 1] instead of [0, 1].\nStep back to when you recorded every occurrence.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → [0, 1], [0, 2], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
