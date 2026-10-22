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
            'message' => "Problem: You get chocolate prices and queries, each with a cap k and a count m. For each query, Bob picks m chocolates; for each one he pays the price up to the cap k and Alice pays the rest, and the relative loss compares what Bob pays with what Alice pays. Return the smallest relative loss for each query. The exact payment rule, the loss definition and the limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nChoose which chocolates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Some cheapest and the rest most expensive', 'next' => 's2'],
                ['label' => 'The m cheapest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Under the guide’s rule, expensive ones are cheap for Bob; the check → 39 instead of 34.\nStep back to when you took the cheapest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A chocolate above the cap costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'k', 'next' => 'wrong_b'],
                ['label' => '2k − p', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Alice’s share counts against the loss; the check → 38 instead of 34.\nStep back to when you used k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O((n + q) log n). The check → 34.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
