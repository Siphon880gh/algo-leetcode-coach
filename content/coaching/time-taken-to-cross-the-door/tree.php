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
            'message' => "Problem: People arrive at a door at given times, in non-decreasing order, each wanting to enter or to exit. The door lets one person through per second. When people in both directions are waiting, a priority rule that depends on how the door was used in the previous second decides who goes first; the exact rule, including ties, is in the official statement. Return the second at which each person crosses. For instance, arrivals [0,1,1] all wanting to enter → [0,1,2]. (Restated from memory; limits and examples may differ slightly.)\nOrder within one direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arrival order, smaller index first', 'next' => 's2'],
                ['label' => 'Larger index first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Ties within a direction go to the smaller index; arrivals [0,0,0] all exiting → [2,1,0] instead of [0,1,2].\nStep back to when you took the larger index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Record each person’s time as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Their arrival time', 'next' => 'wrong_b'],
                ['label' => 'The second they cross', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only one person passes per second; arrivals [0,1,1] all entering → [0,1,1] instead of [0,1,2].\nStep back to when you recorded arrival times.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + max arrival). Constructed checks → [0,1,2], [0,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
