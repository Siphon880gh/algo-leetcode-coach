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
            'message' => "Read the problem statement above.\nNo conflict when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end1 < start2 or end2 < start1', 'next' => 's2'],
                ['label' => 'end1 ≤ start2 or end2 ≤ start1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Both ends are inclusive; Example 1 → false instead of true.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Conflict test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start1 ≤ start2 ≤ end1', 'next' => 'wrong_b'],
                ['label' => 'Neither event ends before the other starts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. event2 may start first; event1 = [02:00, 03:00], event2 = [01:00, 02:30] → false instead of true.\nStep back to when you checked one direction.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
