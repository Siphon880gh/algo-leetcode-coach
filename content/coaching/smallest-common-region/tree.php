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
            'message' => "Problem: Lists of regions are given where the first region in each list directly contains the others. Return the smallest region containing both given regions. For instance, \"Boston\" (in \"United States\", in \"North America\") and \"Canada\" (in \"North America\") give \"North America\". (Restated from memory; limits and examples may differ slightly.)\nParent of each later entry in a list?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first entry of that list', 'next' => 's2'],
                ['label' => 'The previous entry', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The first region contains all the others.\nStep back to when you chained neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Include region1 itself in the ancestor set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. region1 might contain region2.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Walk up from region2 until?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A region in the ancestor set', 'next' => 'success'],
                ['label' => 'The root', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The first shared region is the smallest.\nStep back to when you went to the root.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total regions). Boston and Canada → North America.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
