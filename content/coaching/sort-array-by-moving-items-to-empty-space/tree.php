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
            'message' => "Problem: nums holds each of 0 … n − 1 once, and 0 marks an empty slot. In one operation you move any item into the empty slot, which leaves the slot where that item was. The array counts as sorted when it matches one of the target arrangements the statement describes, with the items in increasing order and the empty slot in one of the allowed places. Return the fewest operations needed. For instance, an array that already matches a target → 0. (Restated from memory; limits and examples may differ slightly.)\nA cycle of length L without the empty slot costs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L + 1', 'next' => 's2'],
                ['label' => 'L − 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The slot must first enter the cycle and then leave it; against [0,1,2,3], [0,2,1,3] → 1 instead of 3.\nStep back to when you charged L − 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Measure against which targets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first one', 'next' => 'wrong_b'],
                ['label' => 'Every allowed target, keep the cheapest', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An array that already matches another target → more than 0 instead of 0.\nStep back to when you used one target.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) per target. Constructed checks → 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
