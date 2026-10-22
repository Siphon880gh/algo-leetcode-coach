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
            'message' => "Problem: You are given the head of a linked list. Return the head of a new linked list that holds, once for each distinct value, how many times that value occurs. The allowed output order is in the official statement. Limits are in the official statement. For instance, values 1, 1, 2, 1, 2, 3 → counts 3, 2, 1 (for 1, 2 and 3). (Restated from memory; limits and examples may differ slightly.)\nEmit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One node per distinct value', 'next' => 's2'],
                ['label' => 'One node per input node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The example → 3, 3, 2, 3, 2, 1.\nStep back to when you emitted per node.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rescan the list for each node', 'next' => 'wrong_b'],
                ['label' => 'A hash map in one pass', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is quadratic in the list length.\nStep back to when you rescanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
