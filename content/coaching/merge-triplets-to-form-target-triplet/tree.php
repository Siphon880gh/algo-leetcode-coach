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
            'message' => "Read the problem statement above.\nTriplet with a coordinate above the target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 's2'],
                ['label' => 'Merge it anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Max can never come back down.\nStep back to when you merged it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merge which safe triplets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those matching a coordinate', 'next' => 'wrong_b'],
                ['label' => 'All of them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra safe merges never hurt.\nStep back to when you filtered more.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Merged == target', 'next' => 'success'],
                ['label' => 'Merged <= target', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every coordinate must be reached exactly.\nStep back to when you allowed less.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
