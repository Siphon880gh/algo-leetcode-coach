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
            'message' => "Read the problem statement above.\nRely on the threads starting in order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: they may start in any order', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The scheduler does not promise that.\nStep back to when you relied on start order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many signals?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One shared lock', 'next' => 'wrong_b'],
                ['label' => 'Two: after first and after second', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A lock does not say which step comes next.\nStep back to when you used one lock.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Busy-wait on a plain flag?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: block on an event or semaphore', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It wastes CPU and may not see the update.\nStep back to when you spun.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Any start order prints \"firstsecondthird\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
