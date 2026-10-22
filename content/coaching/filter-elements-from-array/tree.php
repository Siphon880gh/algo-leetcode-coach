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
            'message' => "Read the problem statement above.\nKeep arr[i] when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'fn(arr[i], i) is truthy', 'next' => 's2'],
                ['label' => 'fn(arr[i], i) === true', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. fn may return numbers; Example 3 → [] instead of [−2,0,1,2].\nStep back to when you compared with true.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arguments to fn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i] only', 'next' => 'wrong_b'],
                ['label' => 'arr[i] and i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Some filters use the index; Example 2 → [] instead of [1].\nStep back to when you dropped i.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [20,30], [1], [−2,0,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
