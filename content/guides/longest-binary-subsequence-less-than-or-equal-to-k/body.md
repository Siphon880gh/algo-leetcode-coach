## Zeros free, ones from the right

1. `ans` = number of 0s; `v = 0`.
2. Walk `s` from the right with bit position `b = 0, 1, …`: at a 1, if `b < 31` and `v + 2^b ≤ k`, add `2^b` to `v` and `ans++`.
3. Return `ans`.

Examples → 5, 6. Checked against trying every subsequence on 300 random strings.

A 1 at position b from the end costs 2^b however many characters are kept before it, so the rightmost 1s are the cheapest. k ≤ 10^9 < 2^30, so stop considering 1s past 30 positions to avoid overflow.

Time: O(n)  
Space: O(1)

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
