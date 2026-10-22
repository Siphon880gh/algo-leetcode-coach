## Running penalty

1. `p = count of Y`, `best = (p, 0)`.
2. For each hour `i`: `p −= 1` for Y, `p += 1` for N; if `p < best.p`, `best = (p, i + 1)`.
3. Return `best.hour`.

Examples → 2, 0, 4. Checked against computing every closing hour’s penalty directly on 300 random strings.

Use strict < so ties keep the earliest hour. Closing at hour n is allowed, as in Example 3.

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
