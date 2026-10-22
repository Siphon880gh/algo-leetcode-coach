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
            'message' => "Read the problem statement above.\nBox order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Largest capacity first', 'next' => 's2'],
                ['label' => 'Smallest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 2.\nStep back to when you started small.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fill up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest pack', 'next' => 'wrong_b'],
                ['label' => 'The total of all packs', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Packs can be split, but every apple still needs room: example 2 → 1 instead of 4.\nStep back to when you used the largest pack.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m log m). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
