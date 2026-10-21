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
            'message' => "Read the problem statement above.\nEqual scores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smaller name ranks better', 'next' => 's2'],
                ['label' => 'The larger name ranks better', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In the example the second get returns alps, ahead of bradford at the same score.\nStep back to when you flipped the names.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push straight into the rest heap', 'next' => 'wrong_b'],
                ['label' => 'Push into the top heap, then move its worst into the rest heap', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A new location better than one in the top heap must displace it.\nStep back to when you skipped the top heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "On get?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move the best of the rest heap into the top heap and return it', 'next' => 'success'],
                ['label' => 'Return the worst of the top heap', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The top heap holds the locations already returned; the next answer is the best of the rest.\nStep back to when you read the top heap.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) per call. Example → branford, alps, bradford, bradford, bradford, orland.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
