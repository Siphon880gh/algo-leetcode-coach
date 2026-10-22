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
            'message' => "Read the problem statement above.\nThe next item is an array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push it with index 0', 'next' => 's2'],
                ['label' => 'Yield it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only integers are yielded; Example 1 → [[[6]],[1,3],[]] instead of [6,1,3].\nStep back to when you yielded the array.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does the parent’s index move past the subarray?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never; read it again after the child ends', 'next' => 'wrong_b'],
                ['label' => 'Before pushing it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The finished subarray is entered again; Example 1 → 6, 6, 6, … without end instead of [6,1,3].\nStep back to when you left the index in place.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total elements). Examples → [6,1,3], [].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
