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
            'message' => "Read the problem statement above.\nCompare with every kept folder?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: after sorting, only the last kept', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting places parents right before children.\nStep back to when you compared all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Prefix test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'startswith(last)', 'next' => 'wrong_b'],
                ['label' => 'startswith(last + "/")', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. /a/b/ca is not inside /a/b/c.\nStep back to when you dropped the slash.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A path is a sub-folder. Update last?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: last stays the parent', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Deeper paths still compare with the top parent.\nStep back to when you replaced last.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · L log n). [\"/a\",\"/a/b\",\"/c/d\",\"/c/d/e\",\"/c/f\"] → [\"/a\",\"/c/d\",\"/c/f\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
