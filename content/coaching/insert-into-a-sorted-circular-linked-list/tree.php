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
            'message' => "Problem: Problem: Given any node of a circular linked list sorted in non-decreasing order around the circle, insert a value so the list stays sorted and circular, and return the given node (or a new one-node circle if the list was empty). (Restated from memory; limits and examples may differ slightly.)\nIs the given node the smallest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not necessarily: it can be anywhere in the circle', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The input node is arbitrary.\nStep back to when you assumed it was the minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "prev.val > cur.val (the wrap). When do you insert there?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never', 'next' => 'wrong_b'],
                ['label' => 'When x ≥ prev.val or x ≤ cur.val', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A new maximum or minimum belongs exactly at the wrap.\nStep back to when you skipped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You loop back to the start without inserting. Why, and then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every value is equal; insert after prev', 'next' => 'success'],
                ['label' => 'Loop again', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A second loop finds nothing new; [3,3,3] has no gap or wrap.\nStep back to when you looped again.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass around the circle: O(n). [3,4,1], insert 2 → [3,4,1,2]. [], insert 1 → [1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
