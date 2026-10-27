## Pair within each parity

1. Split `nums` and `target` into odd and even values; sort each of the four lists.
2. Pair the i-th smallest odd of `nums` with the i-th smallest odd of `target`, and the same for evens.
3. Return `Σ |a − b| / 4` over all pairs.

Examples → 2, 1, 0. Checked against a BFS over small arrays on 200 random reachable cases.

Pairing sorted lists in order moves the least total distance. One operation moves 2 up on one index and 2 down on another, so it covers 4 units of the total difference. The sum can reach 10^5 · 10^6 = 10^11, so use 64-bit.

Time: O(n log n)  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
