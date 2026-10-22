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
            'message' => "Read the problem statement above.\nThe circle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Runs wrap past the end', 'next' => 's2'],
                ['label' => 'Treat it as a line', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [1] instead of [2].\nStep back to when you ignored the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Groups of size s in a run of L?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L div s', 'next' => 'wrong_b'],
                ['label' => 'L − s + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Groups overlap: example 2’s first query → 1 instead of 2.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). Examples → [2], [2, 0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
