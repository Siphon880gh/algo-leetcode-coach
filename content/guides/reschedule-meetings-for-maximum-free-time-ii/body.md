## Per meeting

1. gaps g[0 … n] as in part I; pre[i] = max of g[0 … i − 1], suf[i] = max of g[i … n].
2. For meeting i with length d: base = g[i] + g[i + 1]; if pre[i] ≥ d or suf[i + 2] ≥ d, base += d.
3. Answer the largest base.

Examples → 2, 7, 6, 0. Checked against trying every new position on 400 random small cases.

Always adding d: example 1 → 3 instead of 2.

Time: O(n)  
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
