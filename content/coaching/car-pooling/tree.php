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
            'message' => "Read the problem statement above.\nSimulate each trip location by location?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: record changes at start and end', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(trips · distance).\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do passengers leave?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One location after to', 'next' => 'wrong_b'],
                ['label' => 'At the to location, before new ones board', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They are gone when the car reaches to.\nStep back to when you used to + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Load exceeds capacity at some point. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 'success'],
                ['label' => 'Keep sweeping', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One overload is enough to fail.\nStep back to when you kept sweeping.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(trips + 1001). [[2,1,5],[3,3,7]], capacity 4 → false. [[2,1,5],[3,3,7]], capacity 5 → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
