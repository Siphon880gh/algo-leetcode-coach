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
            'message' => "Problem: Problem: nums2 is a rearrangement of nums1 (duplicates allowed). Return mapping where nums1[i] == nums2[mapping[i]]; any valid mapping is fine. (Restated from memory; limits and examples may differ slightly.)\nSearch nums2 for each element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: build a value → indexes map once', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²).\nStep back to when you searched each time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A value appears twice. What does the map hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the last index', 'next' => 'wrong_b'],
                ['label' => 'A list of its indexes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A list lets duplicates map to different positions.\nStep back to when you kept one index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you take an index for nums1[i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop one from that value\'s list', 'next' => 'success'],
                ['label' => 'Read the first without removing it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Popping keeps each position used once.\nStep back to when you only read.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [12,28,46,32,50], [50,12,32,46,28] → [1,4,3,2,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
