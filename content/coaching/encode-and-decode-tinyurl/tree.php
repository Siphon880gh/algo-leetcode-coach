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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Map a short key to the long URL', 'next' => 's2'],
                ['label' => 'Return the URL itself (or base64 of it)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is not a shortener; the result is as long as the input.\nStep back to when you returned the URL itself.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Random 6-character keys.\nWhat about collisions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore them; they are rare', 'next' => 'wrong_b'],
                ['label' => 'Draw again until the key is unused', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Two URLs with the same key would overwrite each other.\nStep back to when you ignored collisions.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "decode takes the part after the last \"/\" and returns db[key]. A reverse map gives the same code for repeat URLs.\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Key → URL map, collision-free keys, lookup by key', 'next' => 'success'],
                ['label' => 'Decode by searching the map values for the short URL', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Decoding must not need the original URL; only the key is available.\nStep back to when you searched values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. A key-to-URL map with unique keys. decode(encode(url)) == url.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
