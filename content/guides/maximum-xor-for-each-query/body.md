## Flip all low bits

1. `x` = XOR of all nums; `mask = 2^maximumBit − 1`.
2. For each element from the end: append `x ^ mask`; then `x ^= that element`.

Example 1 → `[0,3,2,3]`. Example 2 → `[5,2,6,5]`. Example 3 → `[4,3,6,4,6,7]`.

All values are below `2^maximumBit`, so `x ^ k` can reach `mask` exactly. The sorted order is not needed.

Time: O(n)  
Space: O(1) besides the output

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
