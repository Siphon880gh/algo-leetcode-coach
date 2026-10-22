## Zero the low digits

1. `x = 0`, `p = 10`.
2. While `digitsum(n + x) > target`: `x = (⌊(n + x) / p⌋ + 1) · p − n`; `p *= 10`.
3. Return `x`.

Examples → 4, 33, 0. Checked against counting x up from 0 on 500 random cases.

Adding less than the distance to the next multiple of p only raises the low digits, so the sum cannot fall until they carry over. n ≤ 10^12, so the loop runs at most 13 times; keep values in 64-bit.

Time: O(log² n)  
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
