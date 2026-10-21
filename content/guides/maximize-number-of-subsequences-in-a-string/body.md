## Best insertion is at an end

1. Scan: when `ch = pattern[1]`, `base += seen0`; then if `ch = pattern[0]`, `seen0 += 1`.
2. Return `base + max(count of pattern[0], count of pattern[1])`.
3. If `pattern[0] = pattern[1]` with `c` copies, the answer is `c(c + 1) / 2`.

Examples → 4, 6. Checked against every insertion on 300 random strings.

A pattern[0] placed at the front sees every pattern[1] after it, which no other spot beats. Counts reach about 5 · 10^9, so use 64-bit.

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
