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
            'message' => "Read the problem statement above.\nSort heights?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Descending', 'next' => 's2'],
                ['label' => 'Ascending', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [John, Emma, Mary] instead of [Mary, Emma, John].\nStep back to when you sorted ascending.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep names with heights how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map name to height', 'next' => 'wrong_b'],
                ['label' => 'Sort indices, or map height to name', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated names overwrite each other; Example 2 → [Alice, Bob] instead of [Bob, Alice, Bob].\nStep back to when you keyed by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [Mary, Emma, John], [Bob, Alice, Bob].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
