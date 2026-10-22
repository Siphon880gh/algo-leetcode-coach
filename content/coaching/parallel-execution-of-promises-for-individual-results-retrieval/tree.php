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
            'message' => "Problem: Given an array of functions that each return a promise, start them all and return a promise for an array describing each outcome in input order: whether it fulfilled, with its value, or rejected, with its reason. This is Promise.allSettled, which you implement yourself. The exact field names are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nRecord an outcome by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Writing it at its index', 'next' => 's2'],
                ['label' => 'Pushing it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That orders by finish time; in Node the check → [rejected e, fulfilled 1].\nStep back to when you pushed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Resolve when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last function in the list settles', 'next' => 'wrong_b'],
                ['label' => 'The settled count reaches n', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It may finish first; in Node the check resolves with the first entry still missing.\nStep back to when you watched the last one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The check → [fulfilled 1, rejected e].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
