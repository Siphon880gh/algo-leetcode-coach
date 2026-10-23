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
            'message' => "State:\nbest value for knapsack capacity c\n\nUses best for smaller capacities. Property?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Optimal substructure', 'next' => 'mid'],
                ['label' => 'No overlapping subproblems', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThat composition is optimal substructure.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nfuture needs to know exact item order, but state is only capacity\n\nIssue?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'State too weak — aftereffect / missing info', 'next' => 'final'],
                ['label' => 'DP is globally impossible forever', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nOften fixable by expanding the state.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nDP design checklist starts with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Define the state in words', 'next' => 'success'],
                ['label' => 'Write nested loops with no meaning', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nState first, loops second.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Optimal substructure + well-cut state\n- No hidden aftereffect\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
