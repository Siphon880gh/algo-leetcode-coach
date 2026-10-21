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
            'message' => "Problem: Problem: Each employee has a sorted list of non-overlapping working intervals. Return the finite, positive-length intervals during which all employees are free, in sorted order. (Restated from memory; limits and examples may differ slightly.)\nIntersect each employee's free time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: merge everyone\'s busy time and take the gaps', 'next' => 's2'],
                ['label' => 'Yes, pairwise', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is more work for the same answer.\nStep back to when you intersected free times.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Walking sorted intervals, when is there free time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the next start is greater than the previous interval\'s end', 'next' => 'wrong_b'],
                ['label' => 'When the next start is greater than the latest end so far', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. An earlier long interval can still cover the gap; track the max end.\nStep back to when you used the previous end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you report time before the first or after the last interval?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only finite gaps count', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Those are unbounded and excluded.\nStep back to when you reported them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N log N), or O(N log k) with a heap. [[[1,2],[5,6]],[[1,3]],[[4,10]]] → [[3,4]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
