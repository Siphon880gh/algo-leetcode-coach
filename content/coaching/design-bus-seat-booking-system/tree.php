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
            'message' => "Read the problem statement above.\nBook A2, then B2. getTotalTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '4: A2 now sits next to a booked B2', 'next' => 'wrong_a'],
                ['label' => '2: A2 cost 1 when it was booked', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A seat's cost is fixed when it is booked. Recomputing from the current state gives 4 instead of 2.\nStep back to when you recomputed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A3 and B3 are booked. getMinTime?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2: book A3 first, then B3', 'next' => 'success'],
                ['label' => '4: a window next to a booked middle costs 3', 'next' => 'wrong_b'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. getMinTime may reorder. Booking the window first avoids the delay, so every seat costs 1.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Stored costs, a running total, and a count of booked seats. O(1) per call. Both example sequences match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
