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
            'message' => "Read the problem statement above.\nCompare only the uppercase letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the pattern\'s lowercase letters must appear in order too', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A pattern like \"FoBa\" needs its lowercase letters.\nStep back to when you compared only capitals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query character is uppercase and does not match the pattern. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'The query fails', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only lowercase letters may be inserted.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The query ends. When does it match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the whole pattern was used', 'next' => 'success'],
                ['label' => 'Always, if no uppercase failed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leftover pattern letters mean a mismatch.\nStep back to when you skipped the end check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). queries [\"FooBar\",\"FooBarTest\",\"FootBall\",\"FrameBuffer\",\"ForceFeedBack\"], pattern \"FB\" → [true,false,true,true,false].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
