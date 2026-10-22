## Refill vowel slots

1. `v` = the vowels of s, in order; sort v by ASCII.
2. Walk s; at each vowel position write the next value of v.

Examples → lEOtcede, lYmpH.

ASCII puts every uppercase vowel before every lowercase one. Sorting case-insensitively gives example 1 → lEetcedO instead of lEOtcede. With only 10 vowel characters, counting them sorts in O(n).

Time: O(n log n), O(n) with counting  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
