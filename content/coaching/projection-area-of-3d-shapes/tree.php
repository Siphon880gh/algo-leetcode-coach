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
            'message' => "Read the problem statement above.\nTop view: what does a tower of height 3 add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 's2'],
                ['label' => '3', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. From above, a tower casts one square.\nStep back to when you added the height.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Front view: what does one row add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The sum of its towers', 'next' => 'wrong_b'],
                ['label' => 'Its tallest tower', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Towers in a row hide behind each other.\nStep back to when you summed the row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A cell with height 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adds nothing anywhere', 'next' => 'success'],
                ['label' => 'Adds 1 to the top view', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. An empty cell casts no shadow.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [[1,2],[3,4]] → 17. [[2]] → 5. [[1,0],[0,2]] → 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
