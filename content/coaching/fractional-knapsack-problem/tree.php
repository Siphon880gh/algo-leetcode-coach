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
            'message' => "State:\nvalue per unit of weight: 6, 5 and 4\ncapacity W = 50\nfractions are allowed\n\nWhat do you take first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of the item with ratio 6', 'next' => 'mid'],
                ['label' => 'All of the item with ratio 4', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nThe greedy method takes the highest value per unit of weight first.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nthe items are unchanged\nnow fractions are not allowed (0-1 knapsack)\n\nIs the ratio greedy still always optimal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No. The 0-1 version needs dynamic programming.', 'next' => 'final'],
                ['label' => 'Yes. Greedy always works for any knapsack.', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nThis greedy is only safe when you can take part of an item.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nn items\n\nWhat is the main cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log n), to sort by value per unit of weight', 'next' => 'success'],
                ['label' => 'O(nW), for a DP table', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nThe fractional knapsack is a greedy pass after sorting. No table is needed.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Sort by value per unit of weight.\n- Greedy is optimal when fractions are allowed.\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
