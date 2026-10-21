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
            'message' => "Read the problem statement above.\nFor O(1) space, scan from which end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the end', 'next' => 's2'],
                ['label' => 'From the start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A # only affects characters before it, so scanning forward you cannot know yet whether a letter survives.\nStep back to when you scanned forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You see a \"#\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move left two places', 'next' => 'wrong_b'],
                ['label' => 'skip += 1 and move left', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Several # in a row add up; count them.\nStep back to when you jumped two.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You see a letter while skip > 0. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'skip −= 1 and move left', 'next' => 'success'],
                ['label' => 'Compare it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That letter has been erased.\nStep back to when you compared it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m) time, O(1) space. \"ab#c\", \"ad#c\" → true. \"ab##\", \"c#d#\" → true. \"a#c\", \"b\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
