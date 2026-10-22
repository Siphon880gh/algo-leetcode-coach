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
            'message' => "Problem: You get the head of a circular singly linked list, where the last node points back to the first. Split it into two circular lists: the first half and the second half of the nodes in order, and return both heads. How an odd length is divided, and the limits, are in the official statement; the examples here give the middle node to the first half. For instance, 4 → 8 → 15 → 16 → 23 → [4 → 8 → 15, 16 → 23], and 1 → 2 → [1, 2], each part closing back on itself. (Restated from memory; limits and examples may differ slightly.)\nWhen does a walk stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'On returning to head', 'next' => 's2'],
                ['label' => 'On reaching null', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A circular list has no null; the walk never ends.\nStep back to when you waited for null.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After cutting the first half?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only cut after the first half', 'next' => 'wrong_b'],
                ['label' => 'Point each half’s last node to its own head', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The second half’s last node still points to the old head; 4 → 8 → 15 → 16 → 23 → the second list runs 16, 23, 4, 8, 15, … instead of 16, 23, 16, ….\nStep back to when you left it open.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → [4 → 8 → 15, 16 → 23], [1, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
