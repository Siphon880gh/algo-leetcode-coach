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
            'message' => "Read the problem statement above.\nWhen do [s1, e1) and [s2, e2) overlap?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's1 < e2 and s2 < e1', 'next' => 's2'],
                ['label' => 's1 ≤ e2 and s2 ≤ e1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [10, 20) and [20, 30) only touch; they can both be booked.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "With bookings sorted by start, which ones must you check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them', 'next' => 'wrong_b'],
                ['label' => 'Only the one just before and the one just after the new start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sorted disjoint bookings mean only the neighbors can collide.\nStep back to when you checked all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The booking is rejected. What do you store?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'success'],
                ['label' => 'The part that does not overlap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A rejected booking leaves no trace.\nStep back to when you stored part of it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per booking with a tree map. book(10,20) → true, book(15,25) → false, book(20,30) → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
