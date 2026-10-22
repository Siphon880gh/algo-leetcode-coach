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
            'message' => "Problem: A directed graph has n nodes, and some nodes hold crystals. Add the fewest new directed edges so that every node either holds a crystal or can be reached from a node that does. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nCount?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Source components', 'next' => 's2'],
                ['label' => 'Nodes with no incoming edge', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 5, crystal at 0, edges 0→1, 2→3, 3→2 → 1 instead of 2.\nStep back to when you counted nodes.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A source with a crystal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needs an edge too', 'next' => 'wrong_b'],
                ['label' => 'Needs nothing', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The same check → 3 instead of 2.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). The guide’s check → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
